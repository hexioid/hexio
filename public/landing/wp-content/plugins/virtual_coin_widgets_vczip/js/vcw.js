(function (angular,VCWConstants,fx) {

    var module = angular.module('VCW_FrontedApp',[])

        .constant('vcwColorSchemas',{
            red: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#F44336'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            pink: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#E91E63'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            purple: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#9C27B0'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            deep_purple: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#673AB7'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            indigo: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#3F51B5'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            blue: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#2196F3'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            light_blue: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#03A9F4'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            cyan: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#00BCD4'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            teal: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#009688'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            green: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#4CAF50'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            light_green: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#8BC34A'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            lime: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#CDDC39'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            yellow: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#FFEB3B'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            amber: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#FFC107'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            orange: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#FF9800'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            deep_orange: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#FF5722'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            brown: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#795548'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            grey: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#9E9E9E'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            },
            blue_grey: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#607D8B'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            black: {
                main: {color: 'rgba(255,255,255,0.87)', 'background-color': '#000000'},
                titles: {color: 'rgba(255,255,255,0.65)'},
                divider: {'border-top-color': 'rgba(255,255,255,0.65)'}
            },
            white: {
                main: {color: 'rgba(0,0,0,0.87)', 'background-color': '#ffffff'},
                titles: {color: 'rgba(0,0,0,0.65)'},
                divider: {'border-top-color': 'rgba(0,0,0,0.65)'}
            }
        })

        .factory('vcwChangeIcon',[
            function () {
                return function (change) {
                    return change == null ? 'fa-question' : change > 0 ? 'fa-arrow-up' : change < 0 ? 'fa-arrow-down' : 'fa-circle';
                }
            }
        ])

        .factory('vcwChangeColor',[
            function () {
                return function (change) {
                    return change > 0 ? 'vcw-green' : change < 0 ? 'vcw-red' : change == 0 ? 'vcw-blue' : '';
                }
            }
        ])

        .factory('vcwChangeClasses',['vcwChangeIcon','vcwChangeColor',
            function (vcwChangeIcon,vcwChangeColor) {
                return function (colorSchema) {
                    switch (colorSchema){
                        case 'white':
                        case 'black':
                            return function (change) {
                                return vcwChangeIcon(change) + ' ' + vcwChangeColor(change);
                            };
                        default:
                            return function (change) {
                                return vcwChangeIcon(change);
                            }
                    }
                }
            }
        ])

        .factory('vcwHover',[
            function () {
                var Hover = function () {
                    this.active = false;
                    this.index = null;
                };

                Hover.prototype.statusClass = function (index) {
                    return this.index == null ? '' : index == this.index ? 'vcw-under' : 'vcw-out';
                };

                Hover.prototype.enter = function (index) {
                    this.active = true;
                    this.index = index;
                };

                Hover.prototype.leave = function () {
                    this.active = false;
                    this.index = null;
                };


                return Hover;
            }
        ])

        .service('vcw_data',['$http','$q','$filter','$parse',
            function ($http,$q,$filter,$parse) {
                var self = this;

                self.data = VCWConstants.data;

                self.getVar = function (name,def) {
                    return $parse(name)(self.data) || def;
                };

                self.getBySymbol = function (symbol) {
                    symbol = symbol.toUpperCase();
                    return $filter('filter')(self.getVar('cmc',[]), function (coin) {
                        return coin.symbol && coin.symbol === symbol;
                    })[0];
                };
            }
        ])

        .service('vcw_converter',['vcw_data','$filter',
            function (vcw_data,$filter) {
                var self = this;

                var rates = vcw_data.getVar('rates',{}),
                    currencies = vcw_data.getVar('currencies',{});

                self.currencies = $filter('orderBy')(currencies,'+name');

                fx.rates = rates;
                fx.base = 'BTC';


                self.convert = function (from,to,value) {
                    return fx(value).from(from).to(to);
                };

                self.priceFormat = function (value, count) {
                    var price = null;
                    value = Number(value);

                    if(!isNaN(value)){

                        var val_exp = value.toExponential(count),
                            parts = val_exp.split('e'),
                            exp = Number(parts[1]),
                            diff = count-exp-1;

                        if(diff <= 0){
                            price = value.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        }
                        else{
                            price = value.toFixed(diff);
                        }
                    }

                    return price;
                };

                self.sanitizeNumber = function (number) {
                    if(angular.isString(number) && number.length){
                        var number_parsed = parseFloat(number.replace(/,/g,''));

                        if(angular.isNumber(number_parsed)) return number_parsed;
                    }
                    else if(angular.isNumber(number)) return number;

                    return 0;
                };

                self.convertFormatted = function (from,to,value,n) {
                    var val = self.convert(from,to,self.sanitizeNumber(value));
                    return self.priceFormat(val,n || 5);
                };


                self.attach = function (scope,sym1,sym2) {

                    var converter = scope.converter = {
                        convertFormatted: self.convertFormatted,
                        currencyName: self.currencyName,
                        currencies: self.currencies,
                        selection: [sym1 || 'BTC',sym2 || 'USD'],
                        values: [1,1]
                    };

                    var changed = null;

                    scope.$watch('converter.values[0]',function (newval) {
                        if(changed != 1){
                            converter.values[1] = converter.convertFormatted(converter.selection[0],converter.selection[1],newval);
                            changed = 0;
                        }
                        else {
                            changed = null;
                        }
                    },true);

                    scope.$watch('converter.values[1]',function (newval) {
                        if(changed != 0){
                            converter.values[0] = converter.convertFormatted(converter.selection[1],converter.selection[0],newval);
                            changed = 1;
                        }
                        else {
                            changed = null;
                        }
                    },true);

                    scope.$watch('converter.selection[1]',function (newval,oldvall) {
                        if(newval != oldvall){
                            converter.values[1] = converter.convertFormatted(converter.selection[0],converter.selection[1],converter.values[0]);
                            changed = 0;
                        }
                    },true);

                    scope.$watch('converter.selection[0]',function (newval,oldvall) {
                        if(newval != oldvall){
                            converter.values[0] = converter.convertFormatted(converter.selection[1],converter.selection[0],converter.values[1]);
                            changed = 1;
                        }
                    },true);
                };
            }
        ])

        .directive('vcwPriceLabel',[
            function () {


                var tmpl = '<div class="vcw vcw-price-label" ng-class="classes" ng-style="style.main" ng-click="goTo()">' +
                    '<i class="fa" ng-class="changeClasses(data.percent_change_1h)" aria-hidden="true"></i>' +
                    '<div class="vcw-symbol" ng-bind="data.symbol"></div>' +
                    '<div class="vcw-number" ng-bind="currency + \' \' + price"></div>' +
                    '</div>';

                return {
                    restrict: 'E',
                    scope: {
                        unitSymbol: '=',
                        colorSchema: '=',
                        currency: '=',
                        target: '=',
                        url: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','vcw_data','vcwChangeClasses','vcw_converter','vcwColorSchemas','$window',
                        function ($scope,vcw_data,vcwChangeClasses,vcw_converter,vcwColorSchemas,$window) {

                            $scope.data = vcw_data.getBySymbol($scope.unitSymbol);
                            $scope.colorSchema = $scope.colorSchema || 'white';
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;
                            $scope.changeClasses = vcwChangeClasses($scope.colorSchema);
                            $scope.classes = '';

                            $scope.currency = $scope.currency || 'USD';

                            if($scope.data){
                                $scope.price = vcw_converter.convertFormatted('BTC', $scope.currency, $scope.data.price_btc, 4);
                            }

                            if(angular.isString($scope.url) && $scope.url.length > 0){
                                $scope.goTo = function () {
                                    $window.open($scope.url, $scope.target || '_blank');
                                };

                                $scope.classes += 'vcw-cursor';
                            }
                        }
                    ]
                }
            }
        ])

        .directive('vcwChangeLabel',[
            function () {


                var tmpl = '<div class="vcw vcw-change-label" ng-class="classes" ng-style="style.main" ng-click="goTo()">' +
                        '<i class="fa" ng-class="changeClasses(data.percent_change_1h)" aria-hidden="true"></i>' +
                        '<div class="vcw-symbol" ng-bind="unitSymbol"></div>' +
                        '<div class="vcw-change" ng-bind="data.percent_change_1h + \' %\'"></div>' +
                    '</div>';

                return {
                    restrict: 'E',
                    scope: {
                        unitSymbol: '=',
                        colorSchema: '=',
                        target: '=',
                        url: '='
                    },
                    replace: true,
                    template: tmpl,
                    controller: ['$scope','vcw_data','vcwChangeClasses','vcwColorSchemas','$window',
                        function ($scope,vcw_data,vcwChangeClasses,vcwColorSchemas,$window) {

                            $scope.data = vcw_data.getBySymbol($scope.unitSymbol);
                            $scope.colorSchema = $scope.colorSchema || 'white';
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;
                            $scope.changeClasses = vcwChangeClasses($scope.colorSchema);
                            $scope.classes = '';

                            if(angular.isString($scope.url) && $scope.url.length > 0){
                                $scope.goTo = function () {
                                    $window.open($scope.url, $scope.target || '_blank');
                                };

                                $scope.classes += 'vcw-cursor';
                            }
                        }
                    ]
                }
            }
        ])

        .directive('vcwChangeBigLabel',[
            function () {

                var tmpl = '<div class="vcw vcw-change-big-label" ng-class="classes" ng-style="style.main" ng-click="goTo()">' +
                    '<div class="vcw-symbol" ng-bind="unitSymbol"></div>' +
                    '<div class="vcw-changes">' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 1h</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_1h)"></i><div class="vcw-number" ng-bind="data.percent_change_1h"></div></div>' +
                    '</div>' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 24h</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_24h)"></i><div class="vcw-number" ng-bind="data.percent_change_24h"></div></div>' +
                    '</div>' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 7d</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_7d)"></i><div class="vcw-number" ng-bind="data.percent_change_7d"></div></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';



                return {
                    restrict: 'E',
                    scope: {
                        unitSymbol: '=',
                        colorSchema: '=',
                        target: '=',
                        url: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','$window','vcw_data','vcwChangeClasses','vcwColorSchemas',
                        function ($scope,$window,vcw_data,vcwChangeClasses,vcwColorSchemas) {
                            $scope.data = vcw_data.getBySymbol($scope.unitSymbol);
                            $scope.colorSchema = $scope.colorSchema || 'white';
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;
                            $scope.changeClasses = vcwChangeClasses($scope.colorSchema);
                            $scope.classes = '';


                            if(angular.isString($scope.url) && $scope.url.length > 0){
                                $scope.goTo = function () {
                                    $window.open($scope.url, $scope.target || '_blank');
                                };

                                $scope.classes += 'vcw-cursor';
                            }
                        }
                    ]
                }
            }
        ])

        .directive('vcwPriceBigLabel',[
            function () {

                var tmpl = '<div class="vcw vcw-price-big-label" ng-class="classes" ng-style="style.main" ng-click="goTo()">' +
                    '<div class="vcw-symbol" ng-bind="unitSymbol"></div>' +
                    '<div class="vcw-prices"> ' +
                    '<div class="vcw-price">' +
                    '<div class="vcw-currency" ng-bind="currency1" ng-style="style.titles"></div>' +
                    '<div class="vcw-value" ng-bind="price1"></div>' +
                    '</div>' +
                    '<div class="vcw-price">' +
                    '<div class="vcw-currency" ng-bind="currency2" ng-style="style.titles"></div>' +
                    '<div class="vcw-value" ng-bind="price2"></div>' +
                    '</div>' +
                    '<div class="vcw-price">' +
                    '<div class="vcw-currency" ng-bind="currency3" ng-style="style.titles"></div>' +
                    '<div class="vcw-value" ng-bind="price3"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';



                return {
                    restrict: 'E',
                    scope: {
                        unitSymbol: '=',
                        colorSchema: '=',
                        currency1: '=',
                        currency2: '=',
                        currency3: '=',
                        target: '=',
                        url: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','vcw_data','vcwChangeIcon','vcw_converter','vcwColorSchemas','$window',
                        function ($scope,vcw_data,vcwChangeIcon,vcw_converter,vcwColorSchemas,$window) {
                            $scope.vcwChangeIcon = vcwChangeIcon;
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;
                            $scope.data = vcw_data.getBySymbol($scope.unitSymbol);
                            $scope.classes = '';

                            $scope.currency1 = $scope.currency1 || 'USD';
                            $scope.currency2 = $scope.currency2 || 'EUR';
                            $scope.currency3 = $scope.currency3 || 'GBP';

                            if($scope.data){
                                var price = $scope.data.price_btc || 0;

                                $scope.price1 = vcw_converter.convertFormatted('BTC', $scope.currency1, price,4);
                                $scope.price2 = vcw_converter.convertFormatted('BTC', $scope.currency2, price,4);
                                $scope.price3 = vcw_converter.convertFormatted('BTC', $scope.currency3, price,4);
                            }

                            if(angular.isString($scope.url) && $scope.url.length > 0){
                                $scope.goTo = function () {
                                    $window.open($scope.url, $scope.target || '_blank');
                                };

                                $scope.classes += 'vcw-cursor';
                            }
                        }
                    ]
                }
            }
        ])

        .directive('vcwPriceCard',[
            function () {

                var tmpl = '<div class="vcw vcw-price-card" ng-class="classes" ng-style="style.main" ng-click="goTo()">' +
                    '<div class="vcw-symbol" ng-bind="data.symbol"></div>' +
                    '<div class="vcw-name" ng-style="style.titles" ng-bind="data.name"></div>' +
                    '<div class="vcw-prices">' +
                        '<div class="vcw-price">' +
                            '<div class="vcw-currency" ng-style="style.titles" ng-bind="currency1"></div>' +
                            '<div class="vcw-value" ng-bind="price1"></div>' +
                        '</div>' +
                        '<div class="vcw-price">' +
                            '<div class="vcw-currency" ng-style="style.titles" ng-bind="currency2"></div>' +
                            '<div class="vcw-value" ng-bind="price2"></div>' +
                        '</div>' +
                        '<div class="vcw-price">' +
                            '<div class="vcw-currency" ng-style="style.titles" ng-bind="currency3"></div>' +
                            '<div class="vcw-value" ng-bind="price3"></div>' +
                        '</div>' +
                    '</div>' +
                    '</div>';

                return {
                    restrict: 'E',
                    scope: {
                        unitSymbol: '=',
                        colorSchema: '=',
                        currency1: '=',
                        currency2: '=',
                        currency3: '=',
                        target: '=',
                        url: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','vcwColorSchemas','vcw_data','vcwChangeIcon','vcw_converter','$window',
                        function ($scope,vcwColorSchemas,vcw_data,vcwChangeIcon,vcw_converter,$window) {
                            $scope.data = vcw_data.getBySymbol($scope.unitSymbol);
                            $scope.vcwChangeIcon = vcwChangeIcon;
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;
                            $scope.classes = '';

                            $scope.currency1 = $scope.currency1 || 'USD';
                            $scope.currency2 = $scope.currency2 || 'EUR';
                            $scope.currency3 = $scope.currency3 || 'GBP';

                            if($scope.data){
                                var price = $scope.data.price_btc || 0;

                                $scope.price1 = vcw_converter.convertFormatted('BTC', $scope.currency1, price,4);
                                $scope.price2 = vcw_converter.convertFormatted('BTC', $scope.currency2, price,4);
                                $scope.price3 = vcw_converter.convertFormatted('BTC', $scope.currency3, price,4);
                            }

                            if(angular.isString($scope.url) && $scope.url.length > 0){
                                $scope.goTo = function () {
                                    $window.open($scope.url, $scope.target || '_blank');
                                };

                                $scope.classes += 'vcw-cursor';
                            }

                        }
                    ]
                }
            }
        ])

        .directive('vcwChangeCard',[
            function () {

                var tmpl = '<div class="vcw vcw-change-card" ng-class="classes" ng-style="style.main" ng-click="goTo()">' +
                    '<div class="vcw-symbol" ng-bind="data.symbol"></div>' +
                    '<div class="vcw-name" ng-bind="data.name" ng-style="style.titles"></div>' +
                    '<div class="vcw-changes">' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 1h</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_1h)"></i><div class="vcw-number" ng-bind="data.percent_change_1h"></div></div>' +
                    '</div>' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 24h</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_24h)"></i><div class="vcw-number" ng-bind="data.percent_change_24h"></div></div>' +
                    '</div>' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 7d</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_7d)"></i><div class="vcw-number" ng-bind="data.percent_change_7d"></div></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                return {
                    restrict: 'E',
                    scope: {
                        unitSymbol: '=',
                        colorSchema: '=',
                        target: '=',
                        url: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','vcwColorSchemas','vcw_data','vcwChangeClasses','$window',
                        function ($scope,vcwColorSchemas,vcw_data,vcwChangeClasses,$window) {
                            $scope.data = vcw_data.getBySymbol($scope.unitSymbol);
                            $scope.colorSchema = $scope.colorSchema || 'white';
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;
                            $scope.changeClasses = vcwChangeClasses($scope.colorSchema);
                            $scope.classes = '';


                            if(angular.isString($scope.url) && $scope.url.length > 0){
                                $scope.goTo = function () {
                                    $window.open($scope.url, $scope.target || '_blank');
                                };

                                $scope.classes += 'vcw-cursor';
                            }
                        }
                    ]
                }
            }
        ])

        .directive('vcwConverter',[
            function () {


                var tmpl = '<div class="vcw vcw-converter" ng-style="style.main">' +
                        '<div class="vcw-input">' +
                            '<div class="vcw-currency">' +
                                '<select class="vcw-currency" ng-options="currency.code as currency.name for currency in converter.currencies" ng-model="converter.selection[0]">' +
                                '</select>' +
                            '</div>' +
                            '<div class="vcw-value">' +
                                '<input type="text" ng-model="converter.values[0]">' +
                            '</div>' +
                        '</div>' +
                        '<div class="vcw-input">' +
                            '<div class="vcw-currency">' +
                                '<select class="vcw-currency" ng-options="currency.code as currency.name for currency in converter.currencies" ng-model="converter.selection[1]">' +
                                '</select>' +
                            '</div>' +
                            '<div class="vcw-value">' +
                                '<input type="text" ng-model="converter.values[1]">' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                return {
                    restrict: 'E',
                    scope: {
                        symbol1: '=',
                        symbol2: '=',
                        colorSchema: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','vcwColorSchemas','vcw_converter',
                        function ($scope,vcwColorSchemas,vcw_converter) {
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;
                            vcw_converter.attach($scope,$scope.symbol1,$scope.symbol2);


                        }
                    ]
                }
            }
        ])

        .directive('vcwFullCard',[
            function () {

                var tmpl = '<div class="vcw vcw-full-card" ng-class="classes" ng-style="style.main" ng-click="goTo()">' +
                    '<div class="vcw-symbol" ng-bind="data.symbol"></div>' +
                    '<div class="vcw-name" ng-style="style.titles" ng-bind="data.name"></div>' +
                    '<div class="vcw-prices">' +
                    '<div class="vcw-price">' +
                    '<div class="vcw-currency" ng-style="style.titles" ng-bind="currency1"></div>' +
                    '<div class="vcw-value" ng-bind="price1"></div>' +
                    '</div>' +
                    '<div class="vcw-price">' +
                    '<div class="vcw-currency" ng-style="style.titles" ng-bind="currency2"></div>' +
                    '<div class="vcw-value" ng-bind="price2"></div>' +
                    '</div>' +
                    '<div class="vcw-price">' +
                    '<div class="vcw-currency" ng-style="style.titles" ng-bind="currency3"></div>' +
                    '<div class="vcw-value" ng-bind="price3"></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="vcw-divider" ng-style="style.divider"></div>' +
                    '<div class="vcw-changes">' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 1h</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_1h)"></i><div class="vcw-number" ng-bind="data.percent_change_1h"></div></div>' +
                    '</div>' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 24h</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_24h)"></i><div class="vcw-number" ng-bind="data.percent_change_24h"></div></div>' +
                    '</div>' +
                    '<div class="vcw-change">' +
                    '<div class="vcw-title" ng-style="style.titles">% 7d</div>' +
                    '<div class="vcw-value"><i class="fa" ng-class="changeClasses(data.percent_change_7d)"></i><div class="vcw-number" ng-bind="data.percent_change_7d"></div></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                return {
                    restrict: 'E',
                    scope: {
                        unitSymbol: '=',
                        colorSchema: '=',
                        currency1: '=',
                        currency2: '=',
                        currency3: '=',
                        target: '=',
                        url: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','vcwColorSchemas','vcw_data','vcwChangeClasses','vcw_converter','$window',
                        function ($scope,vcwColorSchemas,vcw_data,vcwChangeClasses,vcw_converter,$window) {
                            $scope.data = vcw_data.getBySymbol($scope.unitSymbol);
                            $scope.colorSchema = $scope.colorSchema || 'white';
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;
                            $scope.changeClasses = vcwChangeClasses($scope.colorSchema);
                            $scope.classes = '';

                            $scope.currency1 = $scope.currency1 || 'USD';
                            $scope.currency2 = $scope.currency2 || 'EUR';
                            $scope.currency3 = $scope.currency3 || 'GBP';

                            if($scope.data){
                                var price = $scope.data.price_btc || 0;

                                $scope.price1 = vcw_converter.convertFormatted('BTC', $scope.currency1, price,4);
                                $scope.price2 = vcw_converter.convertFormatted('BTC', $scope.currency2, price,4);
                                $scope.price3 = vcw_converter.convertFormatted('BTC', $scope.currency3, price,4);
                            }

                            if(angular.isString($scope.url) && $scope.url.length > 0){
                                $scope.goTo = function () {
                                    $window.open($scope.url, $scope.target || '_blank');
                                };

                                $scope.classes += 'vcw-cursor';
                            }

                        }
                    ]
                }
            }
        ])

        .directive('vcwTable',[
            function () {

                var tmpl = '<table class="vcw vcw-table" ng-style="style.main">' +
                        '<thead><tr>' +
                            '<th class="vcw-left vcw-symbol" ng-style="style.titles">Symbol</th>' +
                            '<th class="vcw-left vcw-name" ng-style="style.titles">Name</th>' +
                            '<th class="vcw-right vcw-price" ng-bind="currency" ng-style="style.titles"></th>' +
                            '<th class="vcw-right vcw-change vcw-1h" ng-style="style.titles">Change 1h</th>' +
                            '<th class="vcw-right vcw-change vcw-24h" ng-style="style.titles">Change 24h</th>' +
                            '<th class="vcw-right vcw-change vcw-7d" ng-style="style.titles">Change 7d</th>' +
                        '</thead></tr>' +
                        '<tbody ng-mouseleave="hover.leave()"><tr ng-repeat="cur in currencies track by $index" ng-class="hover.statusClass($index)" ng-mouseenter="hover.enter($index)">' +
                            '<td class="vcw-left vcw-symbol" ng-bind="cur.symbol"></td>' +
                            '<td class="vcw-left vcw-name" ng-bind="cur.name"></td>' +
                            '<td class="vcw-right vcw-price" ng-bind="cur.showing_price"></td>' +
                            '<td class="vcw-right vcw-change vcw-1h" ng-bind="cur.percent_change_1h + \' %\'"></td>' +
                            '<td class="vcw-right vcw-change vcw-24h" ng-bind="cur.percent_change_24h + \' %\'"></td>' +
                            '<td class="vcw-right vcw-change vcw-7d" ng-bind="cur.percent_change_7d + \' %\'"></td>' +
                        '</tr></tbody>' +
                    '</table>';





                return {
                    restrict: 'E',
                    scope: {
                        symbolList: '=',
                        colorSchema: '=',
                        currency: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','vcwColorSchemas','vcw_data','vcw_converter','vcwHover',
                        function ($scope,vcwColorSchemas,vcw_data,vcw_converter,vcwHover) {
                            $scope.currency = $scope.currency || 'USD';
                            $scope.colorSchema = $scope.colorSchema || 'white';
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;

                            $scope.hover = new vcwHover();

                            $scope.currencies = [];

                            (($scope.symbolList || 'BTC,ETH,XRP,LTC,XMR').replace(/ /g,'')).split(',').forEach(function (sym) {
                                var data = vcw_data.getBySymbol(sym);
                                if(data){
                                    data.showing_price = vcw_converter.convertFormatted('BTC', $scope.currency, data.price_btc || 0, 4);
                                    $scope.currencies.push(data);
                                }
                            });

                        }
                    ]
                }
            }
        ])

        .directive('vcwSmallTable',[
            function () {

                var tmpl = '<table class="vcw vcw-small-table" ng-style="style.main">' +
                    '<thead><tr>' +
                    '<th class="vcw-left vcw-name" ng-style="style.titles">Name</th>' +
                    '<th class="vcw-right vcw-price" ng-bind="currency" ng-style="style.titles"></th>' +
                    '<th class="vcw-right vcw-change vcw-1h" ng-style="style.titles">% 1h</th>' +
                    '<th class="vcw-right vcw-change vcw-24h" ng-style="style.titles">% 24h</th>' +
                    '<th class="vcw-right vcw-change vcw-7d" ng-style="style.titles">% 7d</th>' +
                    '</thead></tr>' +
                    '<tbody ng-mouseleave="hover.leave()"><tr ng-repeat="cur in currencies track by $index" ng-class="hover.statusClass($index)" ng-mouseenter="hover.enter($index)">' +
                    '<td class="vcw-left vcw-name" ng-bind="cur.name"></td>' +
                    '<td class="vcw-right vcw-price" ng-bind="cur.showing_price"></td>' +
                    '<td class="vcw-right vcw-change vcw-1h">{{ cur.percent_change_1h }}</td>' +
                    '<td class="vcw-right vcw-change vcw-24h">{{ cur.percent_change_24h }}</td>' +
                    '<td class="vcw-right vcw-change vcw-7d">{{ cur.percent_change_7d }}</td>' +
                    '</tr></tbody>' +
                    '</table>';



                return {
                    restrict: 'E',
                    scope: {
                        symbolList: '=',
                        colorSchema: '=',
                        currency: '='
                    },
                    template: tmpl,
                    replace: true,
                    controller: ['$scope','vcwColorSchemas','vcw_data','vcw_converter','vcwHover',
                        function ($scope,vcwColorSchemas,vcw_data,vcw_converter,vcwHover) {
                            $scope.currency = $scope.currency || 'USD';
                            $scope.colorSchema = $scope.colorSchema || 'white';
                            $scope.style = vcwColorSchemas[$scope.colorSchema] || vcwColorSchemas.white;

                            $scope.hover = new vcwHover();

                            $scope.currencies = [];

                            (($scope.symbolList || 'BTC,ETH,XRP,LTC,XMR').replace(/ /g,'')).split(',').forEach(function (sym) {
                                var data = vcw_data.getBySymbol(sym);
                                if(data){
                                    data.showing_price = vcw_converter.convertFormatted('BTC', $scope.currency, data.price_btc || 0, 4);
                                    $scope.currencies.push(data);
                                }
                            });

                        }
                    ]
                }
            }
        ]);
    
})(angular,VCWConstants,fx);