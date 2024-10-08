<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], [], []],
    '_profiler_xdebug' => [[], ['_controller' => 'web_profiler.controller.profiler::xdebugAction'], [], [['text', '/_profiler/xdebug']], [], [], []],
    '_profiler_font' => [['fontName'], ['_controller' => 'web_profiler.controller.profiler::fontAction'], [], [['text', '.woff2'], ['variable', '/', '[^/\\.]++', 'fontName', true], ['text', '/_profiler/font']], [], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    'CapitalCity_request' => [[], ['_controller' => 'App\\Controller\\CountryInfoController::soapRequest'], [], [['text', '/CountryInfo/CapitalCity']], [], [], []],
    'consultarProcesso_request' => [[], ['_controller' => 'App\\Controller\\EprocController::soapRequestProcesso'], [], [['text', '/eproc/consultarProcesso']], [], [], []],
    'consultarAlteracao_request' => [[], ['_controller' => 'App\\Controller\\EprocController::soapRequestAlteracao'], [], [['text', '/eproc/consultarAlteracao']], [], [], []],
    'consultarAvisosPendentes_request' => [[], ['_controller' => 'App\\Controller\\EprocController::soapRequestAvisosPendentes'], [], [['text', '/eproc/consultarAvisosPendentes']], [], [], []],
    'consultarTeorComunicacao_request' => [[], ['_controller' => 'App\\Controller\\EprocController::soapRequestTeorComunicacao'], [], [['text', '/eproc/consultarTeorComunicacao']], [], [], []],
    'siatu_request' => [[], ['_controller' => 'App\\Controller\\SiatuController::soapRequest'], [], [['text', '/siatu']], [], [], []],
    'soap_request' => [[], ['_controller' => 'App\\Controller\\SoapController::soapRequest'], [], [['text', '/soap']], [], [], []],
    'test_insert' => [[], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::insert'], [], [['text', '/test/insert']], [], [], []],
    'test_read' => [[], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::read'], [], [['text', '/test/read']], [], [], []],
    'test_delete' => [['id'], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/test/delete']], [], [], []],
    'country_update' => [['id'], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::update'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/country/update']], [], [], []],
    'test_insert_form' => [[], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::insertForm'], [], [['text', '/test/insert-form']], [], [], []],
    'process_xml' => [[], ['_controller' => 'App\\Controller\\XmlController::processXml'], [], [['text', '/xml/process']], [], [], []],
    'App\Controller\CountryInfoController::soapRequest' => [[], ['_controller' => 'App\\Controller\\CountryInfoController::soapRequest'], [], [['text', '/CountryInfo/CapitalCity']], [], [], []],
    'App\Controller\EprocController::soapRequestProcesso' => [[], ['_controller' => 'App\\Controller\\EprocController::soapRequestProcesso'], [], [['text', '/eproc/consultarProcesso']], [], [], []],
    'App\Controller\EprocController::soapRequestAlteracao' => [[], ['_controller' => 'App\\Controller\\EprocController::soapRequestAlteracao'], [], [['text', '/eproc/consultarAlteracao']], [], [], []],
    'App\Controller\EprocController::soapRequestAvisosPendentes' => [[], ['_controller' => 'App\\Controller\\EprocController::soapRequestAvisosPendentes'], [], [['text', '/eproc/consultarAvisosPendentes']], [], [], []],
    'App\Controller\EprocController::soapRequestTeorComunicacao' => [[], ['_controller' => 'App\\Controller\\EprocController::soapRequestTeorComunicacao'], [], [['text', '/eproc/consultarTeorComunicacao']], [], [], []],
    'App\Controller\SiatuController::soapRequest' => [[], ['_controller' => 'App\\Controller\\SiatuController::soapRequest'], [], [['text', '/siatu']], [], [], []],
    'App\Controller\SoapController::soapRequest' => [[], ['_controller' => 'App\\Controller\\SoapController::soapRequest'], [], [['text', '/soap']], [], [], []],
    'App\Controller\TestControllerCountryInfo::insert' => [[], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::insert'], [], [['text', '/test/insert']], [], [], []],
    'App\Controller\TestControllerCountryInfo::read' => [[], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::read'], [], [['text', '/test/read']], [], [], []],
    'App\Controller\TestControllerCountryInfo::delete' => [['id'], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/test/delete']], [], [], []],
    'App\Controller\TestControllerCountryInfo::update' => [['id'], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::update'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/country/update']], [], [], []],
    'App\Controller\TestControllerCountryInfo::insertForm' => [[], ['_controller' => 'App\\Controller\\TestControllerCountryInfo::insertForm'], [], [['text', '/test/insert-form']], [], [], []],
    'App\Controller\XmlController::processXml' => [[], ['_controller' => 'App\\Controller\\XmlController::processXml'], [], [['text', '/xml/process']], [], [], []],
];
