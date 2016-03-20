@extends('layouts._app')

@section('header.styles')
<style>
    .stats {
        text-align: center;
    }
    .stat_field{
        border-bottom: 1px solid #97988b;
    }
    .stat_field > small{
        font-weight: normal;
        line-height: 1;
        color: #98978B;
    }
    .custom-rc input[type=radio],
    .custom-rc input[type=checkbox] {
        display:none;
    }
    .custom-rc label {
        display: inline-block;
        /*cursor: pointer;*/
        position: relative;
        padding-right: 25px;
        margin-right:15px;
        font-size: 13px;
        font-weight: normal;
        width:100%;
    }
    .custom-rc label:before {
        content:" ";
        display: inline-block;

        width: 16px;
        height: 16px;

        margin-right: 10px;
        position: relative;
        left: 0;
        top: 1px;
        background-color: #aaa;
        box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
        border-radius: 100%;
        text-align: center;
    }
    .custom-rc.inline label{
        cursor: pointer;
        margin: 0;
        padding: 0;
        width:initial;
    }
    .custom-rc input[type=radio]:checked + label:before,
    .custom-rc input[type=checkbox]:checked + label:before{
        content: "\2022";
        color: #f3f3f3;
        font-size: 33px;
        text-align: center;
        line-height: 17px;
    }
</style>
@endsection

@section('content')
    <div id="vue-container" class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs" style="margin-bottom: 10px;">
                        <li class="active"><a href="#view" data-toggle="tab">View</a></li>
                        <li><a href="#inventory" data-toggle="tab">Inventory</a></li>
                        <li><a href="#journal" data-toggle="tab">Journal</a></li>
                        <li><a href="#debug" data-toggle="tab">Debug</a></li>
                        <li class="pull-right"><a href="">Edit</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="view" class="tab-pane active">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-5">
                                    <h2 class="stat_field"><small>Name:</small> {{ $character->name }}</h2>
                                </div>
                                <div class="col-md-7" style="margin-top: 12px;">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="stat_field"><small>Level &amp; Class:</small> <span v-text="calc.level"></span> <span v-text="calc.class"></span></div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat_field"><small>Background:</small> <span v-text="calc.background"></span></div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat_field"><small>Player:</small> {{ $character->user->name }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="stat_field"><small>Race:</small> <span v-text="calc.race"></span></div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="stat_field"><small>Alignment:</small> <span v-text="calc.alignment"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-md-3 stats">
                                        Strength
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <span v-text="calc.strength"></span>
                                            </div>
                                            <div class="panel-footer" v-text="calc.str"></div>
                                        </div>
                                        Dexterity
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <span v-text="calc.dexterity"></span>
                                            </div>
                                            <div class="panel-footer" v-text="calc.dex"></div>
                                        </div>
                                        Constitution
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <span v-text="calc.constitution"></span>
                                            </div>
                                            <div class="panel-footer" v-text="calc.con"></div>
                                        </div>
                                        Intellegence
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <span v-text="calc.intellegence"></span>
                                            </div>
                                            <div class="panel-footer" v-text="calc.int"></div>
                                        </div>
                                        Wisdom
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <span v-text="calc.wisdom"></span>
                                            </div>
                                            <div class="panel-footer" v-text="calc.wis"></div>
                                        </div>
                                        Charisma
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <span v-text="calc.charisma"></span>
                                            </div>
                                            <div class="panel-footer" v-text="calc.cha"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Inspiration</h3>
                                            </div>
                                            <div class="panel-body">
                                                <span v-text="stats.inspiration"></span>
                                                <div class="pull-right clearfix">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-minus"></i></button>
                                                        <button type="button" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Proficiency Bonus</h3>
                                            </div>
                                            <div class="panel-body" v-text="stats.proficiency"></div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Saving Throws</h3>
                                            </div>
                                            <div class="panel-body custom-rc">
                                                <input type="checkbox" name="str_save" v-model="checkProficiency(stats.str_save)">
                                                <label for="str_save">
                                                    <span class="stat_field" v-text="calc.str_save"></span> Strength
                                                </label>
                                                <input type="checkbox" name="dex_save" v-model="checkProficiency(stats.dex_save)">
                                                <label for="dex_save">
                                                    <span class="stat_field" v-text="calc.dex_save"></span> Dexterity
                                                </label>
                                                <input type="checkbox" name="con_save" v-model="checkProficiency(stats.con_save)">
                                                <label for="con_save">
                                                    <span class="stat_field" v-text="calc.con_save"></span> Constitution
                                                </label>
                                                <input type="checkbox" name="int_save" v-model="checkProficiency(stats.int_save)">
                                                <label for="int_save">
                                                    <span class="stat_field" v-text="calc.int_save"></span> Intellegence
                                                </label>
                                                <input type="checkbox" name="wis_save" v-model="checkProficiency(stats.wis_save)">
                                                <label for="wis_save">
                                                    <span class="stat_field" v-text="calc.wis_save"></span> Wisdom
                                                </label>
                                                <input type="checkbox" name="cha_save" v-model="checkProficiency(stats.cha_save)">
                                                <label for="cha_save">
                                                    <span class="stat_field" v-text="calc.cha_save"></span> Charisma
                                                </label >
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Skills</h3>
                                            </div>
                                            <div class="panel-body custom-rc">
                                                <input type="checkbox" name="acrobatics" v-model="checkProficiency(stat.acrobatics)">
                                                <label for="acrobatics">
                                                    <span class="stat_field" v-text="calc.acrobatics"></span> Acrobatics
                                                </label>
                                                <input type="checkbox" name="animal_handling" v-model="checkProficiency(stat.animal_handling)">
                                                <label for="animal_handling">
                                                    <span class="stat_field" v-text="calc.animal_handling"></span> Animal Handling
                                                </label>
                                                <input type="checkbox" name="arcana" v-model="checkProficiency(stat.arcana)">
                                                <label for="arcana">
                                                    <span class="stat_field" v-text="calc.arcana"></span> Arcana
                                                </label>
                                                <input type="checkbox" name="athletics" v-model="checkProficiency(stat.athletics)">
                                                <label for="athletics">
                                                    <span class="stat_field" v-text="calc.athletics"></span> Athletics
                                                </label>
                                                <input type="checkbox" name="deception" v-model="checkProficiency(stat.deception)">
                                                <label for="deception">
                                                    <span class="stat_field" v-text="calc.deception"></span> Deception
                                                </label>
                                                <input type="checkbox" name="history" v-model="checkProficiency(stat.history)">
                                                <label for="history">
                                                    <span class="stat_field" v-text="calc.history"></span> History
                                                </label>
                                                <input type="checkbox" name="insight" v-model="checkProficiency(stat.insight)">
                                                <label for="insight">
                                                    <span class="stat_field" v-text="calc.insight"></span> Insight
                                                </label>
                                                <input type="checkbox" name="intimidation" v-model="checkProficiency(stat.intimidation)">
                                                <label for="intimidation">
                                                    <span class="stat_field" v-text="calc.intimidation"></span> Intimidation
                                                </label>
                                                <input type="checkbox" name="investigation" v-model="checkProficiency(stat.investigation)">
                                                <label for="investigation">
                                                    <span class="stat_field" v-text="calc.investigation"></span> Investigation
                                                </label>
                                                <input type="checkbox" name="medicine" v-model="checkProficiency(stat.medicine)">
                                                <label for="medicine">
                                                    <span class="stat_field" v-text="calc.medicine"></span> Medicine
                                                </label>
                                                <input type="checkbox" name="nature" v-model="checkProficiency(stat.nature)">
                                                <label for="nature">
                                                    <span class="stat_field" v-text="calc.nature"></span> Nature
                                                </label>
                                                <input type="checkbox" name="perception" v-model="checkProficiency(stat.perception)">
                                                <label for="perception">
                                                    <span class="stat_field" v-text="calc.perception"></span> Perception
                                                </label>
                                                <input type="checkbox" name="performance" v-model="checkProficiency(stat.performance)">
                                                <label for="performance">
                                                    <span class="stat_field" v-text="calc.performance"></span> Performance
                                                </label>
                                                <input type="checkbox" name="persuasion" v-model="checkProficiency(stat.persuasion)">
                                                <label for="persuasion">
                                                    <span class="stat_field" v-text="calc.persuasion"></span> Persuasion
                                                </label>
                                                <input type="checkbox" name="religion" v-model="checkProficiency(stat.religion)">
                                                <label for="religion">
                                                    <span class="stat_field" v-text="calc.religion"></span> Religion
                                                </label>
                                                <input type="checkbox" name="sleight_of_hand" v-model="checkProficiency(stat.sleight_of_hand)">
                                                <label for="sleight_of_hand">
                                                    <span class="stat_field" v-text="calc.slight_of_hand"></span> Sleight Of Hand
                                                </label>
                                                <input type="checkbox" name="stealth" v-model="checkProficiency(stat.stealth)">
                                                <label for="stealth">
                                                    <span class="stat_field" v-text="calc.stealth"></span> Stealth
                                                </label>
                                                <input type="checkbox" name="survival" v-model="checkProficiency(stat.survival)">
                                                <label for="survival">
                                                    <span class="stat_field" v-text="calc.survival"></span> Survival
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title text-center">AC</h3>
                                                </div>
                                                <div class="panel-body text-center" v-text="calc.ac"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title text-center">Initiative</h3>
                                                </div>
                                                <div class="panel-body text-center" v-text="calc.dex"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title text-center">Speed</h3>
                                                </div>
                                                <div class="panel-body text-center" v-text="calc.speed"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Hit Points</h3>
                                        </div>
                                        <div class="panel-body">
                                            <!-- Current Hit Points Form Input -->
                                            <div class="form-group">
                                                <label for="current" class="control-label">Current Hit Points</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="current" class="form-control" v-model="stats.hp_current" />
                                                    <span class="input-group-addon" v-text=" '/ ' + stats.hp_max "></span>
                                                </div>
                                            </div>
                                            <!-- Temporary Hit Points Form Input -->
                                            <div class="form-group">
                                                <label for="temporary" class="control-label">Temporary Hit Points</label>
                                                <input type="text" name="temporary" class="form-control input-sm" v-model="stats.hp_temp" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- <label class="control-label">Hit Die</label>
                                            <p class="form-static-control" v-text="hit_die"></p> -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Hit Die</h3>
                                                </div>
                                                <div class="panel-body" v-text="calc.hp"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Death Saves</h3>
                                                </div>
                                                <div class="panel-body">
                                                    Success:
                                                    <div class="custom-rc clickable inline text-center"> <!-- style="margin-top:0;"> -->
                                                        <input type="checkbox" name="success_1"><label for="success_1"></label>
                                                        <input type="checkbox" name="success_2"><label for="success_2"></label>
                                                        <input type="checkbox" name="success_3"><label for="success_3"></label>
                                                    </div>
                                                    Failures:
                                                    <div class="custom-rc clickable inline text-center"> <!-- style="margin-top:0;"> -->
                                                        <input type="checkbox" name="fail_1"><label for="fail_1"></label>
                                                        <input type="checkbox" name="fail_2"><label for="fail_2"></label>
                                                        <input type="checkbox" name="fail_3"><label for="fail_3"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Proficiencies</h3>
                                            </div>
                                            <div class="panel-body">
                                                <!-- Proficiencies Form Input -->
                                                <div class="form-group">
                                                    <textarea name="proficiencies" rows="12" class="form-control" v-model="stats.proficiencies"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Weapons</h3>
                                        </div>
                                        <div class="panel-body" style="max-height: 50vh;overflow-y: auto;">
                                            <!-- Weapon Form Input -->
                                            <div class="form-group">
                                                <input type="text" name="weapon" class="form-control input-sm" placeholder="Search"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Items</h3>
                                        </div>
                                        <div class="panel-body" style="max-height: 50vh;overflow-y: auto;">
                                            <!-- Item Form Input -->
                                            <div class="form-group">
                                                <input type="text" name="item" class="form-control input-sm" placeholder="Search"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="inventory" class="tab-pane">
                            <div class="row">
                                <div class="col-md-2">
                                    <!-- Cp Form Input -->
                                    <div class="form-group">
                                        <label for="cp" class="control-label">CP</label>
                                        <input type="text" name="cp" class="form-control" v-model="stats.cp" />
                                    </div>
                                    <!-- Sp Form Input -->
                                    <div class="form-group">
                                        <label for="sp" class="control-label">SP</label>
                                        <input type="text" name="sp" class="form-control" v-model="stats.sp" />
                                    </div>
                                    <!-- Ep Form Input -->
                                    <div class="form-group">
                                        <label for="ep" class="control-label">EP</label>
                                        <input type="text" name="ep" class="form-control" v-model="stats.ep" />
                                    </div>
                                    <!-- Gp Form Input -->
                                    <div class="form-group">
                                        <label for="gp" class="control-label">GP</label>
                                        <input type="text" name="gp" class="form-control" v-model="stats.gp" />
                                    </div>
                                    <!-- Pp Form Input -->
                                    <div class="form-group">
                                        <label for="pp" class="control-label">PP</label>
                                        <input type="text" name="pp" class="form-control" v-model="stats.pp" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="journal" class="tab-pane">
                            Journal
                        </div>
                        <div id="debug" class="tab-pane">
                            <pre>{{ print_r($character->items->toArray()) }}</pre>
                            <pre>@{{ $data | json }}</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer.scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script type="text/javascript">
        var floor = Math.floor,
            ceil = Math.ceil,
            extract = function(data){
                for(var key in data)
                    window[key] = data[key];
            },
            evalExpression = function(expression){
                return eval(/\$\{(.+)\}/g.exec(expression)[1]);
            };
        Vue.config.debug = true;
        var vm = new Vue({
            el: "#vue-container",
            data: {
                stats: {!! $character->stats !!},
                calc: {}
            },
            ready: function(){
                this.evalExpressions(this.$data);
            },
            methods: {
                evalExpressions: function(data){ // data = {stats: {}}
                    data.calc = {};
                    // Set all non expressions fields in calculated
                    for(var key in data.stats){
                        if(!/\$\{(.*)\}/.test(data.stats[key])){
                            data.calc[key] = data.stats[key];
                        }
                    }
                    // Make all of the calculated variables local
                    extract(data.calc);
                    // Loop through the expressions, evaluate them, then save them as a local variable
                    for(var key in data.stats){
                        if(/\$\{(.*)\}/.test(data.stats[key]))
                            data.calc[key] = evalExpression(data.stats[key]);
                            window[key] = data.calc[key];
                    }
                    console.log(data.calc);
                },
                checkProficiency: function(expression){
                    return (expression.indexOf('proficiency') > -1);
                }
            }
        });
        $(document).on('click', '.custom-rc.clickable label', function(){
            var target = $(this).prop('for');
            console.log(target);
            var input = $("input[name="+target+"]");
            input.prop('checked', !input.prop('checked'));
        });
    </script>
@endsection