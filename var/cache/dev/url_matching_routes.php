<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/CountryInfo/CapitalCity' => [[['_route' => 'CapitalCity_request', '_controller' => 'App\\Controller\\CountryInfoController::soapRequest'], null, null, null, false, false, null]],
        '/eproc/consultarProcesso' => [[['_route' => 'consultarProcesso_request', '_controller' => 'App\\Controller\\EprocController::soapRequest'], null, null, null, false, false, null]],
        '/eproc/consultarAlteracao' => [[['_route' => 'consultarAlteracao_request', '_controller' => 'App\\Controller\\EprocController::soapRequestAlteracao'], null, null, null, false, false, null]],
        '/eproc/teste' => [[['_route' => 'teste_request', '_controller' => 'App\\Controller\\EprocController::teste'], null, null, null, false, false, null]],
        '/siatu' => [[['_route' => 'siatu_request', '_controller' => 'App\\Controller\\SiatuController::soapRequest'], null, null, null, false, false, null]],
        '/soap' => [[['_route' => 'soap_request', '_controller' => 'App\\Controller\\SoapController::soapRequest'], null, null, null, false, false, null]],
        '/test/insert' => [[['_route' => 'test_insert', '_controller' => 'App\\Controller\\TestControllerCountryInfo::insert'], null, null, null, false, false, null]],
        '/test/read' => [[['_route' => 'test_read', '_controller' => 'App\\Controller\\TestControllerCountryInfo::read'], null, null, null, false, false, null]],
        '/test/insert-form' => [[['_route' => 'test_insert_form', '_controller' => 'App\\Controller\\TestControllerCountryInfo::insertForm'], null, null, null, false, false, null]],
        '/xml/process' => [[['_route' => 'process_xml', '_controller' => 'App\\Controller\\XmlController::processXml'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/test/delete/([^/]++)(*:223)'
                .'|/country/update/([^/]++)(*:255)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        223 => [[['_route' => 'test_delete', '_controller' => 'App\\Controller\\TestControllerCountryInfo::delete'], ['id'], null, null, false, true, null]],
        255 => [
            [['_route' => 'country_update', '_controller' => 'App\\Controller\\TestControllerCountryInfo::update'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
