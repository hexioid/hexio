(function (angular,VCWConstants) {

    var module = angular.module('VCW_AdminApp',['VCW_FrontedApp'])

        .directive('compile', ['$compile', function ($compile) {
            return function(scope, element, attrs) {
                scope.$watch(
                    function(scope) {
                        return scope.$eval(attrs.compile);
                    },
                    function(value) {
                        element.html(value);
                        $compile(element.contents())(scope);
                    }
                );
            };
        }])

        .controller('vcwBuilderCtrl',['$scope','$filter','$sce',
            function ($scope,$filter,$sce) {

                var vm = this;

                vm.shortcodes = [
                    {v: 'price_label', n: 'Price Label'},
                    {v: 'change_label', n: 'Change Label'},
                    {v: 'price_big_label', n: 'Price Big Label'},
                    {v: 'change_big_label', n: 'Change Big Label'},
                    {v: 'price_card', n: 'Price Card'},
                    {v: 'change_card', n: 'Change Card'},
                    {v: 'full_card', n: 'Full Card'},
                    {v: 'converter', n: 'Converter'},
                    {v: 'table', n: 'Table'},
                    {v: 'small_table', n: 'Small Table'}
                ];

                vm.colors = [
                    {v: 'red', n: 'Red'},
                    {v: 'pink', n: 'Pink'},
                    {v: 'purple', n: 'Purple'},
                    {v: 'deep_purple', n: 'Deep Purple'},
                    {v: 'indigo', n: 'Indigo'},
                    {v: 'blue', n: 'Blue'},
                    {v: 'light_blue', n: 'Light Blue'},
                    {v: 'cyan', n: 'Cyan'},
                    {v: 'teal', n: 'Teal'},
                    {v: 'green', n: 'Green'},
                    {v: 'light_green', n: 'Light Green'},
                    {v: 'lime', n: 'Lime'},
                    {v: 'yellow', n: 'Yellow'},
                    {v: 'amber', n: 'Amber'},
                    {v: 'orange', n: 'Orange'},
                    {v: 'deep_orange', n: 'Deep Orange'},
                    {v: 'brown', n: 'Brown'},
                    {v: 'grey', n: 'Grey'},
                    {v: 'blue_grey', n: 'Blue Grey'},
                    {v: 'black', n: 'Black'},
                    {v: 'white', n: 'White'}
                ];

                vm.cryptos = $filter('orderBy')(VCWConstants.data.cmc,'+name');

                vm.currencies = $filter('orderBy')(VCWConstants.data.currencies,'+name');


                vm.settings = {
                    shortcode: 'full_card',
                    color: 'white',
                    symbol: 'BTC',
                    symbols: ['BTC','ETH'],
                    symbols_list: 'BTC,ETH,XRP,LTC,DASH',
                    currency: 'USD',
                    currencies: ['USD','EUR','GBP'],
                    url: '',
                    target: '_blank'
                };

                vm.isShortcode = function () {
                    return angular.isArray(arguments[0]) ?
                        arguments[0].indexOf(vm.settings.shortcode) >= 0 :
                        arguments[0] == vm.settings.shortcode;
                };

                vm.output = '';
                vm.preview_html = '';

                vm.getShortcode = function () {

                    switch (vm.settings.shortcode){
                        case 'price_label':
                            vm.output = '[vcw-price-label '
                                + 'symbol="' + vm.settings.symbol + '" '
                                + 'color="' + vm.settings.color + '" '
                                + 'currency="' + vm.settings.currency + '" '
                                + 'url="' + vm.settings.url + '" '
                                + 'target="' + vm.settings.target + '"'
                                +']';
                            break;

                        case 'change_label':
                            vm.output = '[vcw-change-label '
                                + 'symbol="' + vm.settings.symbol + '" '
                                + 'color="' + vm.settings.color + '" '
                                + 'url="' + vm.settings.url + '" '
                                + 'target="' + vm.settings.target + '"'
                                +']';
                            break;

                        case 'price_big_label':
                            vm.output = '[vcw-price-big-label '
                                + 'symbol="' + vm.settings.symbol + '" '
                                + 'color="' + vm.settings.color + '" '
                                + 'currency1="' + vm.settings.currencies[0] + '" '
                                + 'currency2="' + vm.settings.currencies[1] + '" '
                                + 'currency3="' + vm.settings.currencies[2] + '" '
                                + 'url="' + vm.settings.url + '" '
                                + 'target="' + vm.settings.target + '"'
                                +']';
                            break;

                        case 'change_big_label':
                            vm.output = '[vcw-change-big-label '
                                + 'symbol="' + vm.settings.symbol + '" '
                                + 'color="' + vm.settings.color + '" '
                                + 'url="' + vm.settings.url + '" '
                                + 'target="' + vm.settings.target + '"'
                                +']';
                            break;

                        case 'price_card':
                            vm.output = '[vcw-price-card '
                                + 'symbol="' + vm.settings.symbol + '" '
                                + 'color="' + vm.settings.color + '" '
                                + 'currency1="' + vm.settings.currencies[0] + '" '
                                + 'currency2="' + vm.settings.currencies[1] + '" '
                                + 'currency3="' + vm.settings.currencies[2] + '" '
                                + 'url="' + vm.settings.url + '" '
                                + 'target="' + vm.settings.target + '"'
                                +']';
                            break;

                        case 'change_card':
                            vm.output = '[vcw-change-card '
                                + 'symbol="' + vm.settings.symbol + '" '
                                + 'color="' + vm.settings.color + '" '
                                + 'url="' + vm.settings.url + '" '
                                + 'target="' + vm.settings.target + '"'
                                +']';
                            break;

                        case 'full_card':
                            vm.output = '[vcw-full-card '
                                + 'symbol="' + vm.settings.symbol + '" '
                                + 'color="' + vm.settings.color + '" '
                                + 'currency1="' + vm.settings.currencies[0] + '" '
                                + 'currency2="' + vm.settings.currencies[1] + '" '
                                + 'currency3="' + vm.settings.currencies[2] + '" '
                                + 'url="' + vm.settings.url + '" '
                                + 'target="' + vm.settings.target + '"'
                                +']';
                            break;

                        case 'converter':
                            vm.output = '[vcw-converter '
                                + 'color="' + vm.settings.color + '" '
                                + 'symbol1="' + vm.settings.symbols[0] + '" '
                                + 'symbol2="' + vm.settings.symbols[1] + '"'
                                +']';
                            break;

                        case 'table':
                            vm.output = '[vcw-table '
                                + 'color="' + vm.settings.color + '" '
                                + 'currency="' + vm.settings.currency + '" '
                                + 'symbols="' + vm.settings.symbols_list + '"'
                                +']';
                            break;
                        case 'small_table':
                            vm.output = '[vcw-small-table '
                                + 'color="' + vm.settings.color + '" '
                                + 'currency="' + vm.settings.currency + '" '
                                + 'symbols="' + vm.settings.symbols_list + '"'
                                +']';
                            break;

                        default:
                            vm.output = '';
                    }
                };

                vm.getPreviewHtml = function () {

                    var preview_html = '';

                    switch (vm.settings.shortcode){
                        case 'price_label':
                            preview_html = '<vcw-price-label '
                                + 'unit-symbol="\'' + vm.settings.symbol + '\'" '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'currency="\'' + vm.settings.currency + '\'" '
                                + 'url="\'' + vm.settings.url + '\'" '
                                + 'target="\'' + vm.settings.target + '\'"'
                                +'></vcw-price-label>';
                            break;

                        case 'change_label':
                            preview_html = '<vcw-change-label '
                                + 'unit-symbol="\'' + vm.settings.symbol + '\'" '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'url="\'' + vm.settings.url + '\'" '
                                + 'target="\'' + vm.settings.target + '\'"'
                                +'></vcw-change-label>';
                            break;

                        case 'price_big_label':
                            preview_html = '<vcw-price-big-label '
                                + 'unit-symbol="\'' + vm.settings.symbol + '\'" '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'currency1="\'' + vm.settings.currencies[0] + '\'" '
                                + 'currency2="\'' + vm.settings.currencies[1] + '\'" '
                                + 'currency3="\'' + vm.settings.currencies[2] + '\'" '
                                + 'url="\'' + vm.settings.url + '\'" '
                                + 'target="\'' + vm.settings.target + '\'"'
                                +'></vcw-price-big-label>';
                            break;

                        case 'change_big_label':
                            preview_html = '<vcw-change-big-label '
                                + 'unit-symbol="\'' + vm.settings.symbol + '\'" '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'url="\'' + vm.settings.url + '\'" '
                                + 'target="\'' + vm.settings.target + '\'"'
                                +'></vcw-change-big-label>';
                            break;

                        case 'price_card':
                            preview_html = '<vcw-price-card '
                                + 'unit-symbol="\'' + vm.settings.symbol + '\'" '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'currency1="\'' + vm.settings.currencies[0] + '\'" '
                                + 'currency2="\'' + vm.settings.currencies[1] + '\'" '
                                + 'currency3="\'' + vm.settings.currencies[2] + '\'" '
                                + 'url="\'' + vm.settings.url + '\'" '
                                + 'target="\'' + vm.settings.target + '\'"'
                                +'></vcw-price-card>';
                            break;

                        case 'change_card':
                            preview_html = '<vcw-change-card '
                                + 'unit-symbol="\'' + vm.settings.symbol + '\'" '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'url="\'' + vm.settings.url + '\'" '
                                + 'target="\'' + vm.settings.target + '\'"'
                                +'></vcw-change-card>';
                            break;

                        case 'full_card':
                            preview_html = '<vcw-full-card '
                                + 'unit-symbol="\'' + vm.settings.symbol + '\'" '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'currency1="\'' + vm.settings.currencies[0] + '\'" '
                                + 'currency2="\'' + vm.settings.currencies[1] + '\'" '
                                + 'currency3="\'' + vm.settings.currencies[2] + '\'" '
                                + 'url="\'' + vm.settings.url + '\'" '
                                + 'target="\'' + vm.settings.target + '\'"'
                                +'></vcw-full-card>';
                            break;

                        case 'converter':
                            preview_html = '<vcw-converter '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'symbol1="\'' + vm.settings.symbols[0] + '\'" '
                                + 'symbol2="\'' + vm.settings.symbols[1] + '\'"'
                                +'></vcw-converter>';
                            break;

                        case 'table':
                            preview_html = '<vcw-table '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'currency="\'' + vm.settings.currency + '\'" '
                                + 'symbol-list="\'' + vm.settings.symbols_list + '\'"'
                                +'></vcw-table>';
                            break;
                        case 'small_table':
                            preview_html = '<vcw-small-table '
                                + 'color-schema="\'' + vm.settings.color + '\'" '
                                + 'currency="\'' + vm.settings.currency + '\'" '
                                + 'symbol-list="\'' + vm.settings.symbols_list + '\'"'
                                +'></vcw-small-table>';
                            break;

                        default:
                            preview_html = '';
                    }

                    vm.preview_html = preview_html;
                };


                $scope.$watch(function () {
                    return vm.settings;
                },function () {
                    vm.getShortcode();
                    vm.getPreviewHtml();
                },true);

            }
        ]);


})(angular,VCWConstants);