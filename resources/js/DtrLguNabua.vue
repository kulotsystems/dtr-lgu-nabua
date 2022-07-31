<template>
    <div>
        <div class="bg-primary text-white">
            <div class="container">
                <div align="center" class="pt-3 pb-3 mb-3">
                    <table>
                        <tr>
                            <td class="pe-2">
                                <div id="app-logo">
                                    <img src="img/dtr-lgu-nabua.png">
                                </div>
                            </td>
                            <td class="text-center" id="app-title">
                                <h6 class="m-0"><small><b>LOCAL GOVERNMENT UNIT OF NABUA</b></small></h6>
                                <h3 class="m-0"><b>DAILY TIME RECORD</b></h3>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <iframe id="printer" name="printer" class="d-none"></iframe>
        <div class="container">

            <!-- ERROR MESSAGE -->
            <div class="alert alert-danger" v-if="error != '' && error != 'PLEASE LOGIN FIRST'">
                <div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 text-center">
                    <b>{{ error }}</b>
                </div>
            </div>

            <!-- DOCUMENT LOADING -->
            <div v-if="document.loading" align="center">
                <span class="fa fa-fw fa-spinner fa-pulse"></span> LOADING, PLEASE WAIT...
            </div>

            <!-- DOCUMENT LOADING FINISHED -->
            <div v-if="!document.loading">

                <!-- LOGIN FORM -->
                <div class="row" v-if="success.employee == null">
                    <div class="col-md-6 offset-md-3 col-sm-10 offset-sm-1 mt-3">
                        <div class="form-group">
                            <label for="code">ENTER YOUR <b class="text-primary">ACCOUNT CODE</b>:</label>
                            <input type="password" id="code" class="form-control form-control-lg text-primary" v-bind:readonly="btnLogin.disabled" v-model="code" v-on:keyup.enter="login">
                        </div>
                        <div class="form-group pt-2" align="right">
                            <button class="btn btn-primary" v-bind:disabled="btnLogin.disabled" v-on:click="login">
                                <span class="fa fa-fw" v-bind:class="{'fa-arrow-right': !btnLogin.loading, 'fa-spinner': btnLogin.loading, 'fa-pulse': btnLogin.loading}"></span>
                                LOG IN
                            </button>
                        </div>
                    </div>

                    <!-- ADS ON LOGIN PAGE -->
                    <template v-if="document.width > 767">
                        <div class="col-md-6 mt-3">
                            <ads-enzo-german class="mt-5 mb-3"/>
                        </div>
                        <div class="col-md-6 mt-3 pt-5">
                            <github-sponsor class="mb-4"/>
                            <socmed-twitter/>
                        </div>
                    </template>
                    <template v-else>
                        <div class="col-md-6 mt-3 pt-5">
                            <github-sponsor class="mb-4"/>
                            <socmed-twitter/>
                        </div>
                        <div class="col-md-6">
                            <ads-enzo-german class="mb-5"/>
                        </div>
                    </template>
                </div>

                <!-- MAIN DASHBOARD -->
                <div class="row" v-if="success.employee != null">
                    <div class="col-md-12" align="center">
                        <h4 class="text-uppercase mb-0">
                            <span v-if="success.employee.title !=''">{{ success.employee.title }}</span>
                            <span>{{ success.employee.first_name }}</span>
                            <span v-if="success.employee.middle_name != null"><span v-if="success.employee.middle_name != ''">{{ success.employee.middle_name.substr(0, 1) }}.</span></span>
                            <span>{{ success.employee.last_name }}</span>
                            <span v-if="success.employee.name_suffix != null"><span v-if="success.employee.name_suffix != ''">{{ success.employee.name_suffix }}</span></span>
                        </h4>
                    </div>
                    <div class="col-md-12" v-if="success.designations == null" align="center">
                        <p><span class="fa fa-fw fa-spinner fa-pulse"></span> PLEASE WAIT...</p>
                    </div>
                    <div class="col-md-12" v-if="success.designations != null" align="center">
                        <p v-if="success.designations.length <= 0" class="text-danger">NO DESIGNATIONS FOUND</p>
                        <p v-for="designation in success.designations" class="text-uppercase">
                            <span>{{ designation.position.title }}  @  {{ designation.office.code }}</span>
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-light p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-4 offset-md-4 col-sm-6 offset-sm-3">
                                            <div class="form-group">
                                                <label for="date">SELECT <b class="text-primary">YEAR and MONTH</b>:</label>
                                                <select class="form-control text-uppercase text-primary form-control-lg" id="date" v-model="yearMonth" v-bind:disabled="dtrTable.loading" v-on:change="changeYearMonth">
                                                    <option v-for="month in success.months" v-bind:value="month.year + ',' + month.month">{{ month.label }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered dtr mb-md-1 mb-sm-1 mb-0" v-bind:class="{'loading': dtrTable.loading, 'table-hover': !dtrTable.loading}">
                                    <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th v-for="logMode in success.log_modes" class="text-center text-uppercase">
                                            <span class="d-none d-md-block">{{ logMode.title }}</span>
                                            <span class="d-block d-md-none">{{ logMode.title.substr(0, 1) }}-{{ logMode.title.split(' ')[1] }}</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(dtrValue, dtrDate, dtrIndex) in success.dtr">
                                        <td class="text-center"><small><b>{{ dtrValue.date }}</b></small></td>
                                        <td v-for="logMode in success.log_modes" class="text-center">
                                            <small>{{ dtrValue.logs[logMode.id] }}</small>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p class="ma-0 mt-1 text-center" style="opacity: 0.8">
                                    <small>
                                        Please <a href="https://web.facebook.com/kulotsystems" target="_blank" class="text-decoration-none"><b>contact us</b></a> if your DTR is not updated.
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div v-show="success.designations != null" class="row mb-3">
                <div class="col-md-7" align="center">
                    <div class="pt-5 pb-5">
                        <div class="btn-group dropup">
                            <button class="btn btn-warning" v-bind:disabled="btnPrint.disabled || dtrTable.loading" v-on:click="print('month')">
                                <span class="fa fa-fw" v-bind:class="{'fa-print': !btnPrint.loading, 'fa-spinner': btnPrint.loading, 'fa-pulse': btnPrint.loading}"></span>
                                PRINT DTR
                            </button>
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split"  data-bs-toggle="dropdown" aria-expanded="false" v-bind:disabled="btnPrint.disabled || dtrTable.loading" style="box-shadow: none !important;">
                                <span class="visually-hidden">...</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" v-on:click.prevent="print('month')"><span class="fa fa-fw fa-print text-warning"></span> <span class="text-secondary">{{ success.month }}</span></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" v-on:click.prevent="print('month_half1')"><span class="fa fa-fw fa-print text-warning"></span> <span class="text-secondary">{{ success.month_half1 }}</span></a></li>
                                <li><a class="dropdown-item" href="#" v-on:click.prevent="print('month_half2')"><span class="fa fa-fw fa-print text-warning"></span> <span class="text-secondary">{{ success.month_half2 }}</span></a></li>
                            </ul>
                        </div>
                        <button class="btn btn-outline-danger ms-1" v-bind:disabled="btnLogout.disabled || dtrTable.loading" v-on:click="logout">
                            <span class="fa fa-fw" v-bind:class="{'fa-power-off': !btnLogout.loading, 'fa-spinner': btnLogout.loading, 'fa-pulse': btnLogout.loading}"></span>
                            LOG OUT
                        </button>
                        <hr>
                        <span class="text-primary">PRINT SETTINGS ON <b>GOOGLE CHROME:</b></span>
                        <br>
                        <small>Layout : </small> <code>Landscape</code><small class="text-secondary">;</small>
                        <small>Paper size : </small> <code>A4 / Letter/ Legal</code>
                        <br>
                        <small>Margins : </small> <code>Minimum</code><small class="text-secondary">;</small>
                        <small>Scale : </small> <code>(Custom) 68%</code>
                        <div class="pt-2">
                            <a href="https://www.youtube.com/watch?v=q2b6E13y9mw" target="_blank" class="text-danger" style="text-decoration: none"><span class="fab fa-youtube"></span> <b>Watch:</b> Printing Guide Video</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mt-md-4 mb-5" align="center">
                    <div class="fb-page" data-href="https://www.facebook.com/kulotsystems/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/kulotsystems/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/kulotsystems/">Kulot Systems</a></blockquote></div>
                </div>

                <!-- ADS ON DASHBOARD -->
                <template v-if="document.width > 767">
                    <div class="col-md-6">
                        <ads-enzo-german/>
                    </div>
                    <div class="col-md-6">
                        <github-sponsor class="mb-4"/>
                        <socmed-twitter/>
                    </div>
                </template>
                <template v-else>
                    <div class="col-md-6">
                        <github-sponsor class="mb-4"/>
                        <socmed-twitter/>
                    </div>
                    <div class="col-md-6">
                        <ads-enzo-german class="mb-5"/>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import $ from 'jquery';
    require('bootstrap/dist/js/bootstrap.bundle.js');

    export default {
        name: 'DtrLguNabua',
        components: {
            'ads-enzo-german': () => import('./ads/EnzoGerman.vue'),
            'socmed-twitter' : () => import('./socmed/Twitter.vue'),
            'github-sponsor' : () => import('./ads/GitHubSponsor.vue')
        },
        data() {
            return {
                document : {
                    width  : window.innerWidth,
                    loading: true,
                    title  : 'DTR  LGU Nabua'
                },
                code     : '',
                error    : '',
                success  : {},
                yearMonth: '',
                btnLogin : {
                    disabled: false,
                    loading : false
                },
                btnLogout : {
                    disabled: false,
                    loading : false
                },
                btnPrint : {
                    disabled: false,
                    loading : false
                },
                dtrTable : {
                    loading: false
                }
            }
        },
        methods : {
            onResize: function() {
                this.document.width = window.innerWidth;
            },
            login: function() {
                let app = this;
                app.code = app.code.trim();
                if(app.code != '') {
                    app.error = '';
                    app.btnLogin.disabled = true;
                    app.btnLogin.loading  = true;

                    $.ajax({
                        type: 'POST',
                        url : '/api/employee/login',
                        data: {
                            code: app.code
                        },
                        success: function(data) {
                            app.btnLogin.disabled = false;
                            app.btnLogin.loading  = false;
                            app.code = '';

                            if(data.error != undefined) {
                                if(data.error != '') {
                                    app.error = data.error;
                                    app.code  = '';
                                    app.focusCodeInput();
                                }
                            }
                            else if(data.success != undefined) {
                                app.success = data.success;
                                app.dashboard();
                            }
                        },
                        error: function(data) {
                            app.btnLogin.disabled = false;
                            app.btnLogin.loading  = false;
                            app.error = 'ERROR ' + data.status;
                        }
                    });
                }
            },
            logout: function() {
                let app = this;
                app.error = '';
                app.btnLogout.disabled = true;
                app.btnLogout.loading  = true;
                $.ajax({
                    type: 'POST',
                    url : '/api/employee/logout',
                    success: function(data) {
                        document.title = app.document.title;
                        localStorage.removeItem('dtrLguNabuaYearMonth');
                        app.btnLogout.disabled = false;
                        app.btnLogout.loading  = false;
                        app.success   = {};
                        app.yearMonth = '';
                        app.focusCodeInput();
                    },
                    error: function(data) {
                        app.btnLogout.disabled = false;
                        app.btnLogout.loading  = false;
                        app.error = 'ERROR ' + data.status;
                    }
                });
            },
            dashboard: function() {
                let app = this;
                app.error = '';
                let arrYearMonth = app.getYearMonth();
                $.ajax({
                    type: 'GET',
                    url : '/api/employee/dashboard',
                    data: {
                        year : arrYearMonth.yearMonth[0],
                        month: arrYearMonth.yearMonth[1],
                        mode : 'month'
                    },
                    success: function(data) {
                        app.document.loading = false;
                        app.dtrTable.loading = false;
                        if(data.error != undefined) {
                            if(data.error != '') {
                                app.error = data.error;
                                app.code  = '';
                                app.focusCodeInput();
                            }
                        }
                        else if(data.success != undefined) {
                            app.success = data.success;
                            if(arrYearMonth.yearMonthStored != null)
                                app.yearMonth = arrYearMonth.yearMonthStored;
                            else if(app.yearMonth == '')
                                app.yearMonth = data.success.months[0].year + ',' + data.success.months[0].month;

                            app.changeDocTitle('month');
                        }
                    },
                    error: function(data) {
                        app.document.loading = false;
                        app.dtrTable.loading = false;
                        app.error = 'ERROR ' + data.status;
                    }
                });
            },
            print: function(mode) {
                this.error = '';
                let arrYearMonth = this.getYearMonth();
                if(/Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
                    window.open('/print?year=' + arrYearMonth.yearMonth[0] + '&month=' + arrYearMonth.yearMonth[1] + '&mode=' + mode, '_blank');
                else {
                    this.btnPrint.disabled = true;
                    this.btnPrint.loading  = true;
                    this.changeDocTitle(mode);
                    window.open('/print?year=' + arrYearMonth.yearMonth[0] + '&month=' + arrYearMonth.yearMonth[1] + '&mode=' + mode, 'printer');
                }
            },
            changeYearMonth: function() {
                localStorage.setItem('dtrLguNabuaYearMonth', this.yearMonth);
                this.dtrTable.loading = true;
                this.dashboard();
            },
            getYearMonth: function() {
                let yearMonthStored = localStorage.getItem('dtrLguNabuaYearMonth');
                let yearMonth = yearMonthStored != null ? yearMonthStored.split(',') : (this.yearMonth != '' ? this.yearMonth.split(',') : [2021, 5]);
                return {
                    yearMonthStored: yearMonthStored,
                    yearMonth: yearMonth
                };
            },
            focusCodeInput: function() {
                setTimeout(function() {
                    try {
                        let code = $('#code');
                        code.select();
                        code.focus();
                    } catch(e) {}
                }, 8);
            },
            changeDocTitle: function(mode) {
                document.title = this.success.employee.last_name.toUpperCase() + ' - ' + this['success'][mode].toUpperCase() + ' ' + this.document.title;
            }
        },
        mounted: function() {
            let app = this;
            app.$nextTick(function () {
                window.addEventListener('resize', this.onResize);
                app.dashboard();

                $('#printer').on('load', function() {
                    app.btnPrint.disabled = false;
                    app.btnPrint.loading  = false;

                    $(this)[0].contentWindow.onafterprint = function() {
                        app.changeDocTitle('month');
                    };
                });
            });
        },
        beforeDestroy: function() {
            window.removeEventListener('resize', this.onResize);
        }
    }
</script>

<style>
    table.dtr {
        font-family: monospace;
        opacity: 1;
    }

    table.dtr.loading {
        opacity: 0.4;
    }

    #app-logo {
        position: relative;
        overflow: hidden;
        width: 64px;
        height: 64px;
    }

    #app-logo > img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
    }

    .form-control {
        font-weight: bold;
    }

    @keyframes wheelHueColor {
        from, to { color: #20c997; }
        10%      { color: #17a2b8; }
        20%      { color: #17a2b8; }
        30%      { color: #28a745; }
        40%      { color: #007bff; }
        50%      { color: #6f42c1; }
        60%      { color: #e83e8c; }
        70%      { color: #dc3545; }
        80%      { color: #7e7e7e; }
        90%      { color: #6c757d; }
    }

    .text-rgb {
        color: rgb(236, 100, 75);
        animation: wheelHueColor 24s infinite;
    }
</style>
