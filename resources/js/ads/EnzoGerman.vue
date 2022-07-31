<template>
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0 pt-2 pb-2 text-rgb">
                IN NEED OF GADGET REPAIRS?
            </h4>
        </div>
        <div class="card-body">
            <p><small>JUST CONTACT:</small></p>
            <div align="center">
                <div class="contact" align="left">
                    <h5><small>E N Z O&nbsp;&nbsp;&nbsp;G E R M A N</small></h5>
                    <ul>
                        <li>
                            <span class="fa fa-fw fa-phone text-success"></span>
                            <span>0912 428 3124</span>
                        </li>
                        <li>
                            <span class="fab fa-fw fa-facebook text-primary"></span>
                            <a href="https://www.facebook.com/enzogerman031294" target="_blank">facebook.com/enzogerman031294</a>
                        </li>
                        <li>
                            <span class="fa fa-fw fa-map-marker text-danger"></span>
                            <small>0998 Zone 6, Rail Side, San Francisco, Iriga City</small>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="mt-3"><small>SERVICES OFFERED:</small></p>
            <small>
                <ul class="services mb-0">
                    <li>
                        <big class="text-secondary"><span class="fa fa-fw fa-laptop"></span> <b>LAPTOP / PC REPAIR</b></big>
                        <ul>
                            <li>
                                <span class="badge bg-secondary text-white">OS INSTALLATION</span>
                                <span class="badge bg-secondary text-white">OS REFORMAT</span>
                            </li>
                            <li>
                                <span class="badge bg-secondary text-white">INSTALLING ANTIVIRUS</span>
                                <span class="badge bg-secondary text-white">INSTALLING APPLICATION</span>
                                <span class="badge bg-secondary text-white">INSTALLING GAMES</span>
                            </li>
                            <li>
                                <span class="badge bg-secondary text-white">HARDWARE PROBLEM</span>
                                <span class="badge bg-secondary text-white">LCD PROBLEM</span>
                            </li>
                            <li>
                                <span class="badge bg-secondary text-white">KEYBOARD PROBLEM</span>
                                <span class="badge bg-secondary text-white">BATTERY PROBLEM</span>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <big class="text-success"><span class="fa fa-fw fa-mobile-alt"></span> <b>CELLPHONE REPAIR</b></big>
                        <ul>
                            <li>
                                <span class="badge bg-success text-white">OPEN-LINE</span>
                                <span class="badge bg-success text-white">PASSWORD</span>
                                <span class="badge bg-success text-white">REPROGRAM</span>
                                <span class="badge bg-success text-white">NO POWER</span>
                                <span class="badge bg-success text-white">NOT CHARGING</span>
                            </li>
                            <li>
                                <span class="badge bg-success text-white">BROKEN LCD</span>
                                <span class="badge bg-success text-white">HARDWARE PROBLEM</span>
                                <span class="badge bg-success text-white">BATTERY PROBLEM</span>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <big class="text-secondary"><span class="fab fa-fw fa-apple"></span> <b>iPAD REPAIR</b></big>
                        <ul>
                            <li>
                                <span class="badge bg-secondary text-white">NO POWER</span>
                                <span class="badge bg-secondary text-white">NOT CHARGING</span>
                                <span class="badge bg-secondary text-white">REPROGRAM</span>
                                <span class="badge bg-secondary text-white">BATTERY PROBLEM</span>
                            </li>
                            <li>
                                <span class="badge bg-secondary text-white">HARDWARE PROBLEM</span>
                                <span class="badge bg-secondary text-white">BROKEN TOUCHSCREEN</span>
                                <span class="badge bg-secondary text-white">BROKEN LCD</span>
                            </li>
                        </ul>
                    </li>
                </ul>
            </small>
        </div>
        <div class="card-footer" align="center">
            <small><code class="text-rgb mx-md-3 mx-sm-2 mx-1">#wefixCELLPHONE</code></small>
            <small><code class="text-rgb mx-md-3 mx-sm-2 mx-1">#wefixLAPTOP</code></small>
            <small><code class="text-rgb mx-md-3 mx-sm-2 mx-1">#wefixPC</code></small>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'EnzoGerman',
        components: {},
        data() {
            return {}
        },
        computed: {},
        methods: {}
    }
</script>

<style scoped>
    div.contact {
        display: inline-block;
    }

    div.contact > ul {
        margin : 0;
        padding: 0;
        list-style-type: none;
    }

    div.contact a {
        text-decoration: none;
    }

    ul.services,
    ul.services ul
    {
        list-style-type: none;
    }

    ul.services > li {
        margin-bottom: 20px;
    }

    ul.services > li:last-child {
        margin-bottom: 5px;
    }
</style>
