<?php

namespace App\Http\Controllers;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Hash;
use Session;
use Auth;
use App\PaymentPlan;
use Carbon\Carbon;
use Excel;
use File;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PaymentPlanController extends Controller
{
    // Criar Construtor

    function __construct()
    {
         $this->middleware('auth');
         $this->middleware('permission:planodepagamento-make');
         $this->middleware('permission:planodepagamento-import', ['only' => ['importdata','import']]);

    }
    //classe Index que vai retorna a View

    public function index ()
    {      LogActivity::addToLog('PaymentPlan-form');
        return view('paymentplan_todos.paymentPlan');
    }

    public function searchinformation(Request $request)

    {    LogActivity::addToLog('PaymentPlan - Searche Information '.$request->searchinformation);

        if($request->ajax())

        {

            $output="";

            $products = Cache::remember('cachekey953',0.0166666667, function() use ($request) {


                return DB::table('client_details')
                    ->where('LoanID','=',$request->searchinformation)

                    ->get();
            });

            $products = Cache::get('cachekey953');


            if($products)

            {

                foreach ($products as $key => $product) {

                    $loanamount_=$product->LoanAmount;
                    $loancompoundinterestrate_=$product->LoanCompoundInterestRate;
                    $prestacao_=$product->LoanMonthlyInstallment;
                    $startdate_=$product->LoanCreationTimeStamp;
                    $endDate_ = new Carbon($startdate_); 

                    
                    $endDate_-> addMonths (1);
                    $juro_=$loanamount_*($loancompoundinterestrate_/100);
                    $saldoCapital_=$loanamount_+$juro_-$prestacao_;
                    $capital_=$prestacao_-$juro_;
                    $seguro_=$prestacao_*(9/100);
                    $prestacao_seguro_=$prestacao_+$seguro_;






                    for ($i=1;$i<=$product->LoanTerm;$i++)
                    {
                        $endDate_= $endDate_->addMonths(1);
                        if ($i==$product->LoanTerm) {
                            $saldoCapital_=0;
                            # code...
                        }

                        $output.='<tr>'.
                            '<td>'.$i.'</td>'.
                            '<td>'.$endDate_->format('m-Y').'</td>'.
                            '<td>'.number_format($juro_,2, ',', ' ').'</td>'.
                            '<td>'.number_format($capital_, 2, ',', ' ').'</td>'.
                            '<td>'.number_format($prestacao_,2, ',', ' ').'</td>'.
                            '<td>'.number_format($seguro_,2, ',', ' ').'</td>'.
                            '<td>'.number_format($prestacao_seguro_,2, ',', ' ').'</td>'.
                            '<td>'.number_format($saldoCapital_,2, ',', ' ').'</td>'.

                            '</tr>';
                        $juro_=$saldoCapital_*$loancompoundinterestrate_/100;
                        $saldoCapital_=$saldoCapital_+$juro_-$prestacao_;
                        $capital_=$prestacao_-$juro_;

                    }



                }



                return Response($output);



            }




        }



    }


    public function searchdetails(Request $request)

    {

        if($request->ajax())

        {

            $output="";

            $products = Cache::remember('cachekey9538',0.0166666667, function() use ($request) {


                return DB::table('client_details')
                    ->where('LoanID','=',$request->searchdetails)

                    ->get();
            });

            $products = Cache::get('cachekey9538');


            if($products)

            {

                foreach ($products as $key => $product) {

                    $output.='<tr>'.
                        '<td><strong>'.'Número do Contrato: '.'</strong></td>'.
                        '<td>'.$product->LoanID.'</td>'.
                        '</tr>';

                    $output.='<tr>'.
                        '<td><strong>'.'Nome do Cliente: '.'</strong></td>'.
                        '<td>'.$product->ClientFirstNames.' '.$product->ClientSurname.'</td>'.
                        '</tr>';

                    $output.='<tr>'.
                        '<td><strong>'.'Montante Desembolsado: '.'</strong></td>'.
                        '<td>'.number_format($product->LoanAmount,2,',',' ').'</td>'.
                        '</tr>';

                    $output.='<tr>'.
                        '<td><strong>'.'Período: '.'</strong></td>'.
                        '<td>'.$product->LoanTerm.' Meses'.'</td>'.
                        '</tr>';






                    return Response($output);



                }




            }



        }
    }

    public function importdata(){

        return view('paymentplan_todos.cldr');
    }


    public function import(Request $request){
        $userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
        LogActivity::addToLog('PaymentPlan-import data');
        //validate the xls file
        app()->instance('analysisResults', collect());



        $this->validate($request, array(

            'file'      => 'required|mimes:xlsx,xls,csv|max:5000',

        ));

        if($request->hasFile('file')){

            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $path = $request->file->getRealPath();


                //$data = Excel::load($path, function($reader) {})->all();
                //$delete=DB::delete('delete from client_details');
                $insertData="";


                Excel::filter('chunk')->load($path)->chunk(500, function($reader)  {

                    /*app()->instance('analysisResults', app('analysisResults')->merge($reader));
                    $data=app('analysisResults');
                    $data=$data->all();*/

                    //dd($reader);

                    foreach($reader as $kay => $value)
                    {$userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id

                        $request = new Request([
                            'LoanID' => $value->loanid,
                            'ClientFirstNames' => $value->clientfirstnames,
                            'ClientSurname' => $value->clientsurname,
                            'LoanTerm' => $value->loanterm,
                            'LoanAmount' => $value->loanamount,
                            'LoanCompoundInterestRate' => $value->loancompoundinterestrate,
                            'LoanMonthlyInstallment' => $value->loanmonthlyinstallment,
                            'LoanCreationTimeStamp' => $value->loancreationtimestamp,
                            'ClientDateOfBirth'=>$value->clientdateofbirth,
                            'user_id'=>$userid,
                        ]);


    
                        $this->validate($request,[
                            'LoanID'=>'required|unique:client_details|numeric',
                            'ClientFirstNames'=> 'required|string',
                            'ClientSurname'=> 'required|string',
                            'LoanTerm'=>'required|integer',
                            'LoanAmount'=>'required|numeric',
                            'LoanCompoundInterestRate'=>'required|numeric',
                            'LoanMonthlyInstallment'=>'required|numeric',
                            'LoanCreationTimeStamp'=>'required|date|date_format:Y-m-d',
                            'user_id'=>'required',
                            'ClientDateOfBirth'=>'required',
                
                        ]);
                    }



                    foreach($reader as $kay => $value)
                    {$userid = (!Auth::guest()) ? Auth::user()->id : null ;//user_id
                        //save in database or do whatever you like here


                        $insert[] = [

                            'LoanID' => $value->loanid,
                            'ClientFirstNames' => $value->clientfirstnames,
                            'ClientSurname' => $value->clientsurname,
                            'LoanTerm' => $value->loanterm,
                            'LoanAmount' => $value->loanamount,
                            'LoanCompoundInterestRate' => $value->loancompoundinterestrate,
                            'LoanMonthlyInstallment' => $value->loanmonthlyinstallment,
                            'LoanCreationTimeStamp' => $value->loancreationtimestamp,
                            'ClientID'=>$value->clientid,
                            'Salutation'=>$value->salutation,
                            'ClientEmail'=>$value->clientemail,
                            'ClientDepartmentAndUnit'=>$value->clientdepartmentandunit,
                            'ClientRank'=>$value->clientrank,
                            'ClientIDNumber'=>$value->clientidnumber,
                            'ClientPassportNumber'=>$value->clientpassportnumber,
                            'ClientDateOfBirth'=>$value->clientdateofbirth,
                            'ClientGender'=>$value->clientgender,
                            'ClientMaritalStatus'=>$value->clientmaritalstatus,
                            'PostalAddressLine1'=>$value->postaladdressline1,
                            'PostalAddressLine2'=>$value->postaladdressline2,
                            'PostalAddressLine3'=>$value->postaladdressline3,
                            'PostalAddressLine4'=>$value->postaladdressline4,
                            'PostalAddressPostal'=>$value->postaladdresspostal,
                            'PostalAddressSubRegion'=>$value->postaladdresssubregion,
                            'PostalAddressRegion'=>$value->postaladdressregion,
                            'PostalAddressCountryCode'=>$value->postaladdresscountrycode,
                            'PhysicalAddressLine1'=>$value->physicaladdressline1,
                            'PhysicalAddressLine2'=>$value->physicaladdressline2,
                            'PhysicalAddressLine3'=>$value->physicaladdressline3,
                            'PhysicalAddressLine4'=>$value->physicaladdressline4,
                            'PhysicalAddressPostal'=>$value->physicaladdresspostal,
                            'PhysicalAddressSubRegion'=>$value->physicaladdresssubregion,
                            'PhysicalAddressRegion'=>$value->physicaladdressregion,
                            'PhysicalAddressCountryCode'=>$value->physicaladdresscountrycode,
                            'FaxNumber'=>$value->faxnumber,
                            'MobileNumber'=>$value->mobilenumber,
                            'AfterHours'=>$value->afterhours,
                            'OfficeNumber'=>$value->officenumber,
                            'OtherNumber'=>$value->othernumber,
                            'EmployerID'=>$value->employerid,
                            'EmployerName'=>$value->employername,
                            'EmployerType'=>$value->employertype,
                            'EmployerIndustryTrade'=>$value->employerindustrytrade,
                            'ClientEmployeeNumber'=>$value->clientemployeenumber,
                            'ClientPrevEmployeeNumber'=>$value->clientprevemployeenumber,
                            'ClientDivision'=>$value->clientdivision,
                            'ClientBankAccountHolder'=>$value->clientbankaccountholder,
                            'ClientBankAccountNumber'=>$value->clientbankaccountnumber,
                            'ClientBankAccountType'=>$value->clientbankaccounttype,
                            'ClientBankName'=>$value->clientbankname,
                            'ClientBankCode'=>$value->clientbankcode,
                            'ClientBankBranchName'=>$value->clientbankbranchname,
                            'ClientBankBranchCode'=>$value->clientbankbranchcode,
                            'ClientBankAccountStatus'=>$value->clientbankaccountstatus,
                            'SysUserLoginName'=>$value->sysuserloginname,
                            'NextOfKinID'=>$value->nextofkinid,
                            'NextOfKinFirstNames'=>$value->nextofkinfirstnames,
                            'NextOfKinSurname'=>$value->nextofkinsurname,
                            'NextOfKinEmail'=>$value->nextofkinemail,
                            'NextOfKinRelationship'=>$value->nextofkinrelationship,
                            'NextOfKinGender'=>$value->nextofkingender,
                            'NextOfKinSalutation'=>$value->nextofkinsalutation,
                            'NextOfKinEmployerName'=>$value->nextofkinemployername,
                            'NextOfKinPostalAddressLine1'=>$value->nextofkinpostaladdressline1,
                            'NextOfKinPostalAddressLine2'=>$value->nextofkinpostaladdressline2,
                            'NextOfKinPostalAddressLine3'=>$value->nextofkinpostaladdressline3,
                            'NextOfKinPostalAddressLine4'=>$value->nextofkinpostaladdressline4,
                            'NextOfKinPostalAddressPostal'=>$value->nextofkinpostaladdresspostal,
                            'NextOfKinPostalAddressSubRegion'=>$value->nextofkinpostaladdresssubregion,
                            'NextOfKinPostalAddressRegion'=>$value->nextofkinpostaladdressregion,
                            'NextOfKinPostalAddressCountryCode'=>$value->nextofkinpostaladdresscountrycode,
                            'NextOfKinPhysicalAddressLine1'=>$value->nextofkinphysicaladdressline1,
                            'NextOfKinPhysicalAddressLine2'=>$value->nextofkinphysicaladdressline2,
                            'NextOfKinPhysicalAddressLine3'=>$value->nextofkinphysicaladdressline3,
                            'NextOfKinPhysicalAddressLine4'=>$value->nextofkinphysicaladdressline4,
                            'NextOfKinPhysicalAddressPostal'=>$value->nextofkinphysicaladdresspostal,
                            'NextOfKinPhysicalAddressSubRegion'=>$value->nextofkinphysicaladdresssubregion,
                            'NextOfKinPhysicalAddressRegion'=>$value->nextofkinphysicaladdressregion,
                            'NextOfKinPhysicalAddressCountryCode'=>$value->nextofkinphysicaladdresscountrycode,
                            'NextOfKinFaxNumber'=>$value->nextofkinfaxnumber,
                            'NextOfKinMobileNumber'=>$value->nextofkinmobilenumber,
                            'NextOfKinAfterHours'=>$value->nextofkinafterhours,
                            'NextOfKinOfficeNumber'=>$value->nextofkinofficenumber,
                            'NextOfKinOtherNumber'=>$value->nextofkinothernumber,
                            'LoanStatusReason'=>$value->loanstatusreason,
                            'LoanStatus'=>$value->loanstatus,
                            'LoanArrearsInterestRate'=>$value->loancompoundinterestrate,
                            'LoanArrearsInterestRateORS'=>$value->loanarrearsinterestrateors,
                            'LoanOutlet'=>$value->loanoutlet,
                            'OutletSyncName'=>$value->outletsyncname,
                            'LoanCaptureTimestamp'=>$value->loancapturetimestamp,
                            'LoanContractSignTimestamp'=>$value->loancontractsigntimestamp,
                            'LoanFirstActiveTimestamp'=>$value->loanfirstactivetimestamp,
                            'LoanUsage'=>$value->loanusage,
                            'LoanCollectionMethod'=>$value->loancollectionmethod,
                            'LoanStartPeriod'=>$value->loanstartperiod,
                            'BalInclProvisionalCredits'=>$value->balinclprovisionalcredits,
                            'BalExclProvisionalCredits'=>$value->balexclprovisionalcredits,
                            'TotalCollectable'=>$value->totalcollectable,
                            'UnearnedIncome'=>$value->unearnedincome,
                            'LoanRDR'=>$value->loanrdr,
                            'ArrearsInterestCharged'=>$value->arrearsinterestcharged,
                            'CustomFieldName1'=>$value->customfieldname1,
                            'CustomFieldValue1'=>$value->customfieldvalue1,
                            'CustomFieldName2'=>$value->customfieldname2,
                            'CustomFieldValue2'=>$value->customfieldvalue2,
                            'CustomFieldName3'=>$value->customfieldname3,
                            'CustomFieldValue3'=>$value->customfieldvalue3,
                            'CustomFieldName4'=>$value->customfieldname4,
                            'CustomFieldValue4'=>$value->customfieldvalue4,
                            'CustomFieldName5'=>$value->customfieldname5,
                            'CustomFieldValue5'=>$value->customfieldvalue5,
                            'CustomFieldName6'=>$value->customfieldname6,
                            'CustomFieldValue6'=>$value->customfieldvalue6,
                            'CustomFieldName7'=>$value->customfieldname7,
                            'CustomFieldValue7'=>$value->customfieldvalue7,
                            'CustomFieldName8'=>$value->customfieldname8,
                            'CustomFieldValue8'=>$value->customfieldvalue8,
                            'CustomFieldName9'=>$value->customfieldname9,
                            'CustomFieldValue9'=>$value->customfieldvalue9,
                            'CustomFieldName10'=>$value->customfieldname10,
                            'CustomFieldValue10'=>$value->customfieldvalue10,
                            'user_id'=>$userid,
                        ];

                    }

                    //dd($insert);
                 
                    if(!empty($insert)){

                        $insertData = PaymentPlan::insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }       


                });



                return back();

            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }

}
