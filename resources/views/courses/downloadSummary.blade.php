<!doctype html>
<html lang="en">

    <head>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            html {
                margin-left: 10%;
                margin-right:10%;
                font-family: 'Open Sans', sans-serif;
                line-height: 1.15;
            }

            .panel, p {
                font-size: 80%;
            }

            .panel p {
                font-size: 100%;
            }

            .table>thead>tr>td.info,
            .table>tbody>tr>td.info,
            .table>tfoot>tr>td.info,
            .table>thead>tr>th.info,
            .table>tbody>tr>th.info,
            .table>tfoot>tr>th.info,
            .table>thead>tr.info>td,
            .table>tbody>tr.info>td,
            .table>tfoot>tr.info>td,
            .table>thead>tr.info>th,
            .table>tbody>tr.info>th,
            .table>tfoot>tr.info>th {
            background-color: #cfe2ff;
            }

            .table>thead>tr>td.active,
            .table>tbody>tr>td.active,
            .table>tfoot>tr>td.active,
            .table>thead>tr>th.active,
            .table>tbody>tr>th.active,
            .table>tfoot>tr>th.active,
            .table>thead>tr.active>td,
            .table>tbody>tr.active>td,
            .table>tfoot>tr.active>td,
            .table>thead>tr.active>th,
            .table>tbody>tr.active>th,
            .table>tfoot>tr.active>th {
            background-color: #e2e3e5;
            }

            .alert-warning {
                color: #664d03;
                background-color: #fff3cd;
                border-color: #ffecb5;
            }



        </style>
    </head>
    <body>

        <!-- Course Info -->
        <div style="margin-bottom:16px">
            <p class="text-right">{{date("Y-m-d")}}</p>
            <h2>{{$course->course_code}}{{$course->course_num}}: Course Summary</h2>
            <p><b>Course:</b> {{$course->course_code}}{{$course->course_num}} {{$course->section}} {{$course->course_title}}</p>
            <p><b>Term:</b> {{$course->year}} {{$course->semester}}</p>
            <p><b>Mode of Delivery:</b>
            @switch($course->delivery_modality)
                @case('O')
                    Online
                    @break
                @case('B')
                    Hybrid
                    @break
                @default
                    In-person
            @endswitch
            </p>
            <p><b>Level: </b>{{$courseStandardCategory->sc_name}}</p>
        </div>
        <!-- End of Course Info -->

        <!-- CLOs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Course Learning Outcomes</h4></div>
                @if(count($l_outcomes)<1)
                    <div class="alert alert-warning text-center">
                        There are no course learning outcomes set for this course.                     
                    </div>
                @else
                    <table class="table" >
                        <tr class="info">
                            <th class="text-center">#</th>
                            <th>Course Learning Outcome</th>
                        </tr>

                        @foreach($l_outcomes as $index => $l_outcome)
                        <tr>
                            <td class="text-center" style="width:5%" ><strong>{{$index+1}}</strong></td>
                            <td>
                                <strong>{{$l_outcome->clo_shortphrase}}</strong><br>
                                    {{$l_outcome->l_outcome}}
                            </td>
                        </tr>
                        @endforeach


                    </table>
                @endif
        </div>
        <!-- End of CLOs -->

        <!-- Student Assessment Methods -->
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Student Assessment Methods</h4></div>
                @if(count($a_methods)<1)
                    <div class="alert alert-warning text-center">
                        There are no student assessment methods set for this course.                     
                    </div>
                @else
                    <table class="table">
                        <tr class="info">
                            <th class="text-center">#</th>
                            <th>Student Assessment Method</th>
                            <th>Weight</th>
                        </tr>

                        @foreach($a_methods as $index => $a_method)
                        <tr>
                            <td class="text-center" style="width:5%" ><strong>{{$index+1}}</strong></td>
                            <td>{{$a_method->a_method}}</td>
                            <td>{{$a_method->weight}}%</td>
                        </tr>
                        @endforeach

                        <tr class="active" style="font-weight:bold">
                            <td></td>
                            <td>Total</td>
                            <td>{{$assessmentMethodsTotal}}%</td>
                        </tr>


                    </table>
                @endif
        </div>
        <!-- End of Student Assessment Methods -->

        <!-- Teaching and Learning Activities -->
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Teaching and Learning Activities</h4></div>
                @if(count($l_activities)<1)
                    <div class="alert alert-warning text-center">
                        There are no teaching and learning activities set for this course.                     
                    </div>
                @else
                    <table class="table">
                        <tr class="info">
                            <th class="text-center">#</th>
                            <th>Teaching and Learning Activity</th>
                        </tr>

                        @foreach($l_activities as $index => $l_activity)
                        <tr>
                            <td class="text-center" style="width:5%" ><strong>{{$index+1}}</strong></td>
                            <td>{{$l_activity->l_activity}}</td>
                        </tr>
                        @endforeach
                    </table>
                @endif
        </div>
        <!-- End of Teaching and Learning Activities -->

        <!-- Course Alignment -->
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Course Alignment</h4></div>
                @if(count($l_outcomes)<1)
                    <div class="alert alert-warning text-center">
                        There are no course learning outcomes set for this course.                     
                    </div>
                @else
                    @if ($outcomeActivities->count() < 1 && $outcomeAssessments->count() < 1)
                        <div class="alert alert-warning text-center">
                            Course learning outcomes have not been constructively aligned with student assessment methods and teaching and learning activities for this course.                     
                        </div>
                    @else 
                        <table class="table">
                            <tr class="info">
                                <th class="text-center">#</th>
                                <th>Course Learning Outcome</th>
                                <th>Student Assessment Method</th>
                                <th>Teaching and Learning Activity</th>
                            </tr>

                            @foreach($l_outcomes as $index => $l_outcome)
                            <tr>
                                <th class="text-center" style="width:5%">{{$index+1}}</th>
                                <td>{{$l_outcome->l_outcome}}</td>
                                <td>
                                    @foreach($outcomeAssessments as $oa)
                                        @if($oa->l_outcome_id == $l_outcome->l_outcome_id )
                                            {{$oa->a_method}}<br>
                                        @endif

                                    @endforeach
                                </td>
                                <td>
                                    @foreach($outcomeActivities as $oa)
                                        @if($oa->l_outcome_id == $l_outcome->l_outcome_id )
                                            {{$oa->l_activity}}<br>
                                        @endif

                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @endif
                @endif
            
        </div>
        <!-- End of Course Alignment -->

        <!-- Program Outcome Maps -->
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Program Outcome Maps</h4></div>
            
            @if($coursePrograms->count() <1 )
                <div class="alert alert-warning text-center">
                    This course does not belong to any programs yet.                     
                </div>
            @else
                @foreach ($coursePrograms as $index => $courseProgram)
                <div style="margin-left:16px; margin-right:16px;">
                    <div class="panel-heading" style="font-weight:bold;text-decoration:underline">
                        <h5>Program {{$index + 1}}. {{$courseProgram->program}}</h5>
                    </div>

                    <div class="panel-body">
                        <h5 class="font-weight:bold">Program Learning Outcomes</h5>
                        @if ($programsLearningOutcomes[$courseProgram->program_id]->count() < 1)
                            <div class="alert alert-warning text-center">
                                Program learning outcomes have not been set for this program.                     
                            </div>
                        @else 
                            <table class="table">
                                <tr class="info">
                                    <th class="text-center">#</th>
                                    <th>Program Learning Outcome</th>
                                </tr>
                            
                                @if ($courseProgram->ploCategories->count() > 0)
                                    @foreach ($courseProgram->ploCategories as $ploCategory) 
                                        <tr>
                                            <td colspan="2" class="active">{{$ploCategory->plo_category}}</td>
                                        </tr>
                                        @foreach ($ploCategory->plos as $index => $plo)
                                            <tr>
                                                <td style="width:5%" >{{($index++) + 1}}</td>
                                                <td>
                                                    <strong>{{$plo->plo_shortphrase}}</strong><br>
                                                    {{$plo->pl_outcome}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td class="active" colspan="2">Uncategorized PLOs</td>
                                    </tr>
                                    @foreach ($courseProgram->programLearningOutcomes as $plo) 
                                        @if (!isset($plo->category))
                                            <tr>
                                                <td>{{($index++) + 1}}</td>
                                                <td>
                                                    <strong>{{$plo->plo_shortphrase}}</strong><br>
                                                    {{$plo->pl_outcome}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach   
                                @else                                                 
                                    @foreach($courseProgram->programLearningOutcomes as $index => $pl_outcome)
                                        <tr>
                                            <td style="width:5%" >{{$index + 1}}</td>
                                            <td>
                                                <strong>{{$pl_outcome->plo_shortphrase}}</strong><br>
                                                {{$pl_outcome->pl_outcome}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        @endif

                        <h5 class="font-weight:bold">Mapping Scale</h5>
                        <p>The mapping scale indicates the degree to which a program learning outcome is addressed by a course learning outcome.</p>
                        @if ($programsMappingScales[$courseProgram->program_id]->count() < 1) 
                            <div class="alert alert-warning text-center">
                                A mapping scale has not been set for this program.                      
                            </div>
                        @else 
                            <table class="table">
                                <tr class="info">
                                    <th colspan="2">Mapping Scale</th>
                                </tr>
    
                                @foreach($programsMappingScales[$courseProgram->program_id] as $programMappingScale)
                                <tr>
                                    <td>
                                        <div style="background-color:{{$programMappingScale->colour}}; height: 10px; width: 10px;"></div>
                                        {{$programMappingScale->title}}<br>
                                        ({{$programMappingScale->abbreviation}})
                                    </td>
                                    <td>
                                        {{$programMappingScale->description}}
                                    </td>
                                </tr>
                                @endforeach
                            </table> 
                        @endif
                        
                        <h5 class="font-weight:bold">Program Outcome Map: Course Learning Outcomes to Program Learning Outcomes</h5>
                        <p>This chart shows the alignment of course learning outcomes to program learning outcomes for this program.</p>
                        
                        @if (!array_key_exists($courseProgram->program_id, $courseProgramsOutcomeMaps))
                            <div class="alert alert-warning text-center">
                                Course learning outcomes have not been mapped to this programs learning outcomes.                            
                            </div>
                        @else 
                            <table class="table" style="margin:0; width:100%; table-layout:fixed;">
                                <tr class="info">
                                    <th>CLOs</th>
                                    <th colspan="{{$programsLearningOutcomes[$courseProgram->program_id]->count()}}">Program Learning Outcomes (PLOs)</th>
                                </tr>
                                @if ($courseProgram->ploCategories->count() > 0)
                                    <tr>
                                        <td></td>
                                        @foreach ($courseProgram->ploCategories as $ploCategory)
                                            <td class="active" colspan="{{$ploCategory->plos->count()}}">{{$ploCategory->plo_category}}</td>
                                        @endforeach
                                        <td colspan="{{$courseProgram->programLearningOutcomes->count() - $courseProgram->numPlosCategorized}}"></td>
                                    </tr>
                                @endif
                                <tr>
                                    @if ($programsLearningOutcomes[$courseProgram->program_id]->count() > 7)
                                        <td></td>
                                        @foreach ($programsLearningOutcomes[$courseProgram->program_id] as $index => $programLearningOutcome)
                                        <td style="text-align:center;font-size:80%">
                                            {{$index+1}}
                                        </td>
                                        @endforeach
                                    @else 
                                        <td></td>
                                        @foreach ($programsLearningOutcomes[$courseProgram->program_id] as $index => $programLearningOutcome)
                                        <td style="height:0; vertical-align: bottom; text-align: left; overflow:hidden;">
                                            <span @if($programsLearningOutcomes[$courseProgram->program_id]->count() <=4) style="font-size: 100%;"@else style="font-size: 80%;"@endif>
                                                @if(isset($programLearningOutcome->plo_shortphrase))
                                                {{$index+1}}.{{$programLearningOutcome->plo_shortphrase}}
                                                @else
                                                    {{$index+1}}
                                                @endif
                                            </span>
                                        </td>
                                        @endforeach
                                    @endif
                                </tr>
                                @foreach($l_outcomes as $clo_index => $l_outcome)
                                <tr>
                                    <td style="height: auto; white-space: nowrap; overflow: hidden;max-width: 8em;">
                                        <span style= "font-size: 80%;">
                                        @if(isset($l_outcome->clo_shortphrase))
                                            {{$clo_index + 1}}. {{$l_outcome->clo_shortphrase}}
                                        @else
                                            {{$clo_index +1}}
                                        @endif
                                        </span>
                                    </td>

                                    @foreach($programsLearningOutcomes[$courseProgram->program_id] as $pl_outcome)
                                        <!-- Check if this PLO has been mapped -->
                                        @if (!array_key_exists($pl_outcome->pl_outcome_id, $courseProgramsOutcomeMaps[$courseProgram->program_id]))
                                        <td></td> 
                                        @else 
                                        <!-- Check if this PLO has been mapped to this CLO -->
                                            @if (!array_key_exists($l_outcome->l_outcome_id, $courseProgramsOutcomeMaps[$courseProgram->program_id][$pl_outcome->pl_outcome_id]))
                                                <td></td>
                                            @else 
                                                <td style="text-align:center;padding:4px;font-size:80%;">
                                                    <div @foreach($programsMappingScales[$courseProgram->program_id] as $programMappingScale) @if($programMappingScale->abbreviation == $courseProgramsOutcomeMaps[$courseProgram->program_id][$pl_outcome->pl_outcome_id][$l_outcome->l_outcome_id]) style="margin:auto;background-color:{{$programMappingScale->colour}}"@endif @endforeach>
                                                        <p @if($courseProgramsOutcomeMaps[$courseProgram->program_id][$pl_outcome->pl_outcome_id][$l_outcome->l_outcome_id] == 'A') style="color:white;" @endif>
                                                            {{$courseProgramsOutcomeMaps[$courseProgram->program_id][$pl_outcome->pl_outcome_id][$l_outcome->l_outcome_id]}}
                                                        </p>
                                                </div>
                                                </td>                                            
                                            @endif
                                        @endif                                                         
                                    @endforeach
                                </tr>
                                @endforeach
                            </table>
                        @endif 
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <!-- End of Program Outcome Maps -->

        <!-- Standards Outcome Maps-->
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Standards Outcome Maps</h4></div>
            
            @if($standardOutcomeMaps->count() <1 )
                <div class="alert alert-warning text-center">
                    Course learning outcomes have not been mapped to standards for this course.                    
                </div>
            @else 
                <div style="margin-left:16px; margin-right:16px;">

                    <h5 class="font-weight:bold">Standards</h5>
                    @if ($courseStandards->count() < 1)
                            <div class="alert alert-warning text-center">
                                Standards have not been set for this program.                            
                            </div>
                    @else 
                        <table class="table">
                            <tr class="info">
                                <th class="text-center">#</th>
                                <th>Standards</th>            
                            </tr>
                            
                            @foreach($courseStandards as $index => $standard)
                            <tr>
                                <th class="text-center" style="width:5%">{{$index+1}}</th>
                                <td>
                                    <strong>{{$standard->s_shortphrase}}</strong><br>
                                    {{$standard->s_outcome}}

                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @endif

                    <h5 class="font-weight:bold">Standards Mapping Scale</h5>
                    <p>The mapping scale indicates the degree to which a ministry standard is addressed by a course learning outcome.</p>
                    @if ($courseStandardScales->count() < 1) 
                        <div class="alert alert-warning text-center">
                            A mapping scale has not been set for this program.                            
                        </div>
                    @else 
                        <table class="table">
                            <tr class="info">
                                <th colspan="2">Mapping Scale</th>
                            </tr>
        
                            @foreach($courseStandardScales as $standardScale)
                            <tr>
                                <td>
                                    <div style="background-color:{{$standardScale->colour}}; height: 10px; width: 10px;"></div>
                                    {{$standardScale->title}}<br>
                                    ({{$standardScale->abbreviation}})
                                </td>
                                <td>
                                    {{$standardScale->description}}
                                </td>
                            </tr>
                            @endforeach
                        </table> 
                    @endif
                            
                    <h5 class="font-weight:bold">Program Outcome Map: {{$courseStandardCategory->sc_name}}</h5>
                    <p>This chart shows the alignment of course learning outcomes to ministry standards.</p>
                            
                    @if (count($standardOutcomeMaps)<1)
                        <div class="alert alert-warning text-center">
                            Course learning outcomes have not been mapped to standards yet.                            
                        </div>
                    @else 
                        <table class="table" style="width:100%; table-layout:fixed;">
                            <tr class="info">
                                <th style="width:25%">Course Learning Outcomes (CLOs)</th>
                                <th colspan="{{$courseStandards->count()}}">Standards</th>
                            </tr>
        
                            <tr>
                                @if ($courseStandards->count() > 7)
                                    <td></td>
                                        @foreach ($courseStandards as $index => $standard)
                                            <td style="text-align:center;font-size:80%">
                                                {{$index+1}}
                                            </td>
                                        @endforeach
                                @else 
                                    <td></td>
                                    @foreach ($courseStandards as $index => $standard)
                                        <td style="height:0; vertical-align: bottom; text-align: left; overflow:hidden;">
                                            <span @if($courseStandards->count() <=4) style="font-size: 100%;"@else style="font-size: 80%;"@endif>
                                                @if(isset($standard->s_shortphrase))
                                                    {{$index+1}}.{{$standard->s_shortphrase}}
                                                @else
                                                    {{$index+1}}
                                                @endif
                                            </span>
                                        </td>
                                    @endforeach
                                @endif
                            </tr>
                            
                            @foreach($l_outcomes as $clo_index => $l_outcome)
                                <tr>
                                    <td style="height: auto; white-space: nowrap; overflow: hidden;
                                            max-width: 8em;">
                                                <span style= "font-size: 80%;">
                                                @if(isset($l_outcome->clo_shortphrase))
                                                    {{$clo_index + 1}}. {{$l_outcome->clo_shortphrase}}
                                                @else
                                                    {{ $clo_index + 1 }}
                                                @endif
                                                </span>
                                    </td>
                                    @foreach($courseStandards as $standard)
                                            <!-- Check if this CLO has been mapped to this PLO -->
                                            @foreach($standardOutcomeMaps as $som)
                                                @if( $som->standard_id == $standard->standard_id && $som->l_outcome_id == $l_outcome->l_outcome_id )
                                                    <td style="text-align:center;padding:4px;font-size:80%;">
                                                        <div @foreach($courseStandardScales as $standardScale) @if($standardScale->abbreviation == $som->map_scale_value) style="margin:auto;background-color:{{$standardScale->colour}}"@endif @endforeach>
                                                            <p @if($som->map_scale_value == 'A') style="color:white;" @endif>
                                                                {{$som->map_scale_value}}
                                                            </p>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div> 
            @endif
        </div>
        <!-- End of Standards Outcome Maps-->

        <!-- Optional Alignment to UBC and Ministry Standards -->
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Optional Alignment to UBC and Ministry Standards</h4></div>
                @if(count($optional_PLOs)<1)
                    <div class="alert alert-warning text-center">
                        This course has not aligned with any UBC and Ministry Priorities.                    
                    </div>
                @else
                    <table class="table">
                        <tr class="info">
                            <th class="text-center">#</th>
                            <th>Aligned UBC and Ministry Priority</th>
                        </tr>

                        @foreach ($optional_PLOs as $index => $optional_Plo)
                        <tr>
                            <td class="text-center" style="width:5%" ><strong>{{$index+1}}</strong></td>
                            <td>{{$optional_Plo->custom_PLO}}</td>
                        </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </body>
</html>

