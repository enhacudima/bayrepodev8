<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Bayport | MIS',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Bayport</b> MIS',

    'logo_mini' => '<b>B</b>MIS',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout'  => 'fixed',


    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [

        'MENU PRINCIPAL',

        [
            'text'    => 'Aplicações',
            'icon'    => 'th',
            'submenu' => [
                [
                    'text'    => 'MyTicket',
                    'url'     => 'myticket',
                    'icon'    => 'ticket',
                    'submenu' =>[
                        [
                            'text'       =>'Criar um novo Ticket',
                            'url'        =>'newtticket',
                            'icon_color' =>'yellow',
                            'can'        =>'myticket-creat-edit',


                        ],
                        [
                            'text'       =>'Tickets Activos',
                            'url'        =>'myticket',
                            'icon_color' =>'yellow',


                        ],
                        [
                            'text'       =>'Tickets Fechados',
                            'url'        =>'completticket',
                            'icon_color' =>'yellow',


                        ],
                        [
                            'text'       =>'Dashboard',
                            'url'        =>'ticketpainel',
                            'icon_color' =>'yellow',
                            'can'        =>'myticket-admin',


                        ],
                        [
                            'text'       =>'Report',
                            'url'        =>'ticketreport',
                            'icon_color' =>'yellow',
                            'can'        =>'myticket-admin',


                        ],
                        [
                            'text'       =>'Commited Tickets',
                            'url'        =>'committicket',
                            'icon_color' =>'yellow',
                            'can'        =>'myticket-admin',


                        ],
                        [
                            'text'       =>'Settings',
                            'url'        =>'#',
                            'icon_color' =>'red',
                            'can'        =>'myticket-admin',
                            'submenu'    =>[
                                        [
                                            'text'       =>'Document',
                                            'url'        =>'document.index',
                                            'icon_color' =>'red',


                                         ],
                                         [
                                            'text'       =>'Agents',
                                            'url'        =>'agents',
                                            'icon_color' =>'red',


                                        ],
                                        [
                                            'text'       =>'Categories',
                                            'url'        =>'categories',
                                            'icon_color' =>'red',
                                            'submenu'    =>[
                                                        [
                                                            'text'       =>'Categories',
                                                            'url'        =>'categories',
                                                            'icon_color' =>'red',

                                                        ],
                                                        [
                                                            'text'       =>'Sub-Categories',
                                                            'url'        =>'subcategories',
                                                            'icon_color' =>'red',

                                                        ],

                                            ],

                                        ],
                                                                                [
                                            'text'       =>'Teams',
                                            'url'        =>'teams',
                                            'icon_color' =>'red',

                                        ],






                            ],


                        ],


                    ],
                ],
                [
                    'text'    => 'Arquivo Master',
                    'url'     => 'arquipainel',
                    'icon'    => 'archive',
                    'can'     => 'arquivomaster-view',
                    'submenu' => [
                        [
                            'text'       => 'Dashboard',
                            'url'        => 'arquipainel',
                            'icon_color' => 'yellow',
                            'can'        => 'arquivomaster-dashboard',
                        ],
                        [
                            'text'       => 'Master',
                            'url'        => 'arquivomaster',
                            'icon_color' => 'yellow',
                            'submenu' => [
                                [
                                    'text'       => 'Full Master',
                                    'url'        => 'arquivomaster',
                                    'icon_color' => 'red',
                                ],
                                [
                                    'text'       => 'Referência',
                                    'url'        => 'arquivoreferencias',
                                    'icon_color' => 'yellow',
                                ],
                            ],
                        ],
                        [
                            'text'       => 'Reporte',
                            'url'        => 'arquivoreportindexreport',
                            'icon_color' => 'yellow',
                            'can'        => 'arquivomaster-report',
                        ],
                    ],
                ],
                [
                   
    
                    'text'    => 'QA',
                    'url'     => 'homefuncionario',
                    'icon'    => 'search-plus',
                    'can'     => 'qa-nib',
                    'submenu' => [

                        [
                            'text'       => 'NIB verfication',
                            'url'        => 'homefuncionario',
                            'icon_color' => 'green',
                            'can'        => 'qa-nib',
                            'submenu' => [

                                            [
                                            'text'       => 'NIB',
                                            'url'        => 'homefuncionario',
                                            'icon_color' => 'green',
                                            'can'        => 'qa-nib',
                                            ],   
                                             [
                                                'text'       => 'Salario',
                                                'url'        => 'homesal',
                                                'icon_color' => 'green',
                                                'can'        => 'qa-sal',
                                            ],
                                            [
                                                'text'       => 'Cadastrar Novo',
                                                'url'        => 'funcionarionovo',
                                                'icon_color' => 'red',
                                                'can'        => 'qa-new',
                                            ],
                            ],
                        ],
                        [
                            'text'       => 'EFT',
                            'url'        => 'eft/show',
                            'icon_color' => 'green',
                            'can'        => 'eft-eft-view',
                        ],

                    ],
                ],
                [
                    'text'       => 'Plano de Pagamento',
                    'url'        => 'paymentPlan',
                    'icon'       => 'line-chart',
                    'icon_color' => 'green',
                    'can'        => 'planodepagamento-make',
                       'submenu' => [
                        [
                            'text'       => 'Plano de Pagamento',
                            'url'        => 'paymentPlan',
                            'icon_color' => 'green',
                            'can'        => 'planodepagamento-make',
                        ],
                        [
                            'text'       => 'Caregar Ficheiro',
                            'url'        => 'importdata',
                            'icon_color' => 'red',
                            'can'        => 'planodepagamento-import',
                        ],

                    ],


                ],               
                [
                    'text'       => 'Black List',
                    'url'        => 'index-blacklist',
                    'icon'       => 'exclamation',
                    'icon_color' => 'red',
                    'can'        => 'blacklists',
                       'submenu' => [
                        [
                            'text'       => 'Black List',
                            'url'        => '/index-blacklist',
                            'icon_color' => 'red',
                            'can'        => 'blacklists-view',
                        ],
                        [
                            'text'       => 'Add to Black List',
                            'url'        => '/blacklists/add',
                            'icon_color' => 'red',
                            'can'        => 'blacklists-create',
                        ],
                        [
                            'text'       => 'AML',
                            'url'        => '/peps/index',
                            'icon_color' => 'red',
                            'can'        => 'blacklists-peps-view',
                        ],
                        [
                            'text'       => 'Q.A. Check',
                            'url'        => '/checks/index',
                            'icon_color' => 'red',
                            'can'        => 'blacklists-checks-view',
                        ],
                        [
                            'text'       => 'Branch Check',
                            'url'        => '/branchs/index',
                            'icon_color' => 'green',
                            'can'        => 'blacklists-branchs-view',
                        ],

                    ],


                ],
                                [
                    'text'       => 'Agent Payroll',
                    'url'        => 'selection',
                    'icon'       => 'paypal',
                    'can'        => 'recibos-view',

                ],
            ],
        ],
        'SETTINGS',
        [
            'text'       => 'Admin',
            'icon_color' => 'red',
            'icon'       => 'cog',
            'permission' => 'create-post',
            'can'        => 'user-list',
            'submenu'    => [
                        [
                            'text'       => 'Manage Users',
                            'route'      => 'users.index',
                            'icon_color' => 'red',
                            'can'        => 'user-list',
                        ],
                        [
                            'text'       => 'Manage Role',
                            'route'      => 'roles.index',
                            'icon_color' => 'red',
                            'can'        => 'role-list',
                        ],
                        [
                            'text'       => 'Log-Activity',
                            'url'        => 'logActivity',
                            'icon_color' => 'red',
                            'can'        => 'admin-logatracker',
                        ],
                        [
                            'text'       => 'Log-viewer',
                            'url'        => 'log-viewer',
                            'icon_color' => 'green',
                            'can'        => 'admin-logatracker',
                        ],



                    ],

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
     
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => false,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
