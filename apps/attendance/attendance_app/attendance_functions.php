<?php   

function schedule($schedule, $date_array){
    // dump($schedule);
    $TimeIn_Am = "";
    $TimeOut_Am = "";
    $TimeIn_Pm = "";
    $TimeOut_Pm = "";
    $TimeArray = [];
    foreach($date_array as $a):
        $week_name = date('l', strtotime($a["Date"]));
        $sched = $schedule[$week_name];
        $a["Time"] = date('H:i', strtotime($a["Time"]));
        if($sched["am_in"] != ""):
            if($TimeIn_Am == ""):
                $am_in = strtotime($sched["am_in"]);
                $beforeTime = date("H:i", strtotime('-2 hours', $am_in));
                $afterTime = date("H:i", strtotime('+2 hours', $am_in));
                if($a["Time"] >= $beforeTime && $a["Time"] <= $afterTime){
                    $TimeIn_Am = $a["Time"];
                }
            endif;
        endif;
        if($sched["am_out"] != ""):
            if($TimeOut_Am == ""):
                $am_out = strtotime($sched["am_out"]);
                $beforeTime = date("H:i", strtotime('-4 hours', $am_out));
                $afterTime = date("H:i", strtotime('+4 hours', $am_out));
                if($a["Time"] >= $beforeTime && $a["Time"] <= $afterTime){
                    $TimeOut_Am = $a["Time"];
                }
            endif;
        endif;
        if($sched["pm_in"] != ""):
            if($TimeIn_Pm == ""):
                $pm_in = strtotime($sched["pm_in"]);
                $beforeTime = date("H:i", strtotime('-4 hours', $pm_in));
                $afterTime = date("H:i", strtotime('+4 hours', $pm_in));
                if($a["Time"] >= $beforeTime && $a["Time"] <= $afterTime){
                    $TimeIn_Pm = $a["Time"];
                }
            endif;
        endif;
        if($sched["pm_out"] != ""):
            if($TimeOut_Pm == ""):
                $pm_out = strtotime($sched["pm_out"]);
                $beforeTime = date("H:i", strtotime('-4 hours', $pm_out));
                $afterTime = date("H:i", strtotime('+4 hours', $pm_out));
                if($a["Time"] >= $beforeTime && $a["Time"] <= $afterTime){
                    $TimeOut_Pm = $a["Time"];
                }
            endif;
        endif;
    endforeach;
    $TimeArray[0]["date"] = $a["Date"];
    $TimeArray[0]["time_in_am"] = $TimeIn_Am;
    $TimeArray[0]["time_out_am"] = $TimeOut_Am;
    $TimeArray[0]["time_in_pm"] = $TimeIn_Pm;
    $TimeArray[0]["time_out_pm"] = $TimeOut_Pm;
    $TimeArray[0]["overtime_in"] = "";
    $TimeArray[0]["overtime_out"] = "";
    $TimeArray[0]["time_out_pm"] = $TimeOut_Pm;
    $TimeArray[0]["number_lates"] = 0;
    $TimeArray[0]["minutes_lates"] = 0;
    return($TimeArray);
}

function regular_schedule($date_array){

    $TimeIn_Am = "";
    $TimeOut_Am = "";
    $TimeIn_Pm = "";
    $TimeOut_Pm = "";
    $Overtime_In = "";
    $Overtime_Out = "";
    $TimeOut_Pm = "";
    $TimeArray = [];

    $in = "12:00";
    $in_minutes = "60";
    $break_out = "12:00";
    $break_out_minutes = "60";
    $break_in = "13:00";
    $break_in_minutes = "60";
    $out = "17:00";
    $out_minutes = "60";



    
    $overtime_in = "";
    $overtime_out = "";

    $a= $date_array;
    $new_time = [];
    foreach($a as $aa):
        $aa["Time"] = date('H:i', strtotime($aa["Time"]));
        $new_time[$aa["Time"]] = $aa;
    endforeach;
    $a = $new_time;



$time_in_am = "";
foreach($a as $aa):
    if($aa["OutIn"] == "4" || $aa["OutIn"] == "5"):
        foreach($a as $aa):
            if($aa["OutIn"] == "4"):
                    $overtime_in = $aa["Time"];
                    $my_id = $aa["Time"];
                    unset($a[$my_id]);
            endif;
      
            endforeach;
            foreach($a as $aa):
                if($aa["OutIn"] == "5"):
                    $overtime_out = $aa["Time"];
                    $my_id = $aa["Time"];
                    unset($a[$my_id]);
                endif;
            endforeach;
else:
    if($time_in_am != ""){
        $my_id = $aa["Time"];
        unset($a[$my_id]);
        break;
    }
    else{

        $my_id = $aa["Time"];
        $aa["Time"] = date('H:i', strtotime($aa["Time"]));
        $time = strtotime($in);
        $startTime = date("H:i", strtotime('-'.$in_minutes.' minutes', $time));
        $endTime = date("H:i", strtotime('+'.$in_minutes.' minutes', $time));

        if($aa["Time"] < "12:00" && $aa["Time"] >= "05:30"){
            $time_in_am = $aa["Time"];
            unset($a[$my_id]);
            break;
        }


    

    }
endif;
   
endforeach;


$time_out_am = "";
foreach($a as $aa):
    
    if($aa["OutIn"] == "4" || $aa["OutIn"] == "5"):
        foreach($a as $aa):
            if($aa["OutIn"] == "4"):
                    $overtime_in = $aa["Time"];
                    $my_id = $aa["Time"];
                    unset($a[$my_id]);
            endif;
      
            endforeach;
            foreach($a as $aa):
                if($aa["OutIn"] == "5"):
                    $overtime_out = $aa["Time"];
                    $my_id = $aa["Time"];
                    unset($a[$my_id]);
                endif;
            endforeach;
else:
    $my_id = $aa["Time"];
    $aa["Time"] = date('H:i', strtotime($aa["Time"]));
    $time = strtotime($break_out);
    $startTime = date("H:i", strtotime('-'.$break_out_minutes.' minutes', $time));
    $endTime = date("H:i", strtotime('+'.$break_out_minutes.' minutes', $time));
   
    if($aa["Time"] >= $startTime && $aa["Time"] <= $endTime){

        
        if($aa["Time"] >= "12:00" && $aa["Time"] <= "13:00"){
            $time_out_am = $aa["Time"];
            unset($a[$my_id]);
            break;
        }

        else{
            if($time_out_am != ""){
                unset($a[$my_id]);
                break;
            }
            else{
                $time_out_am = $aa["Time"];
                unset($a[$my_id]);
            }
        }
    }
endif;
endforeach;

$time_in_pm = "";
foreach($a as $aa):

    if($aa["OutIn"] == "4" || $aa["OutIn"] == "5"):
        foreach($a as $aa):
            if($aa["OutIn"] == "4"):
                    $overtime_in = $aa["Time"];
                    $my_id = $aa["Time"];
                    unset($a[$my_id]);
            endif;
      
            endforeach;
            foreach($a as $aa):
                if($aa["OutIn"] == "5"):
                    $overtime_out = $aa["Time"];
                    $my_id = $aa["Time"];
                    unset($a[$my_id]);
                endif;
            endforeach;
else:
    $my_id = $aa["Time"];
    $aa["Time"] = date('H:i', strtotime($aa["Time"]));
    $time = strtotime($break_in);
    $startTime = date("H:i", strtotime('-'.$break_in_minutes.' minutes', $time));
    $endTime = date("H:i", strtotime('+'.$break_in_minutes.' minutes', $time));
  
    if($aa["Time"] >= $startTime && $aa["Time"] <= $endTime){
        if($aa["Time"] >= "12:00" && $aa["Time"] <= "13:00"){
            $time_in_pm = $aa["Time"];
            unset($a[$my_id]);
            break;
        }

        else{
            if($time_in_pm != ""){
                unset($a[$my_id]);
                break;
            }
            else{
                $time_in_pm = $aa["Time"];
                unset($a[$my_id]);
            }
        }
       
    }
endif;
endforeach;


$time_out_pm = "";
foreach($a as $aa):
if($aa["OutIn"] == "4" || $aa["OutIn"] == "5"):
    
    foreach($a as $aa):
        if($aa["OutIn"] == "4"):
                $overtime_in = $aa["Time"];
                $my_id = $aa["Time"];
                unset($a[$my_id]);
        endif;
  
        endforeach;
        foreach($a as $aa):
            if($aa["OutIn"] == "5"):
                $overtime_out = $aa["Time"];
                $my_id = $aa["Time"];
                unset($a[$my_id]);
            endif;
        endforeach;


else:
    $my_id = $aa["Time"];
    $aa["Time"] = date('H:i', strtotime($aa["Time"]));
    $time = strtotime($out);
    $the_time = $out;
    $startTime = date("H:i", strtotime('-'.$out_minutes.' minutes', $time));
    $endTime = date("H:i", strtotime('+'.$out_minutes.' minutes', $time));

    if($aa["Time"] >= $the_time){
        $time_out_pm = $aa["Time"];
        unset($a[$my_id]);
        break;
    }
    else if($aa["Time"] >= $startTime){
        $time_out_pm = $aa["Time"];
        unset($a[$my_id]);
    }

    if($aa["Time"] > "13:00"){
        $time_out_pm = $aa["Time"];
        unset($a[$my_id]);
    }
endif;
endforeach;





    




if($time_in_am == "" && $time_in_pm == ""){
    $time_in_pm = $time_out_am;
    $time_out_am = "";
}


foreach($a as $aa):
    if($aa["OutIn"] == "4"):
            $overtime_in = $aa["Time"];
            $my_id = $aa["Time"];
            unset($a[$my_id]);
    endif;

    endforeach;
    foreach($a as $aa):
        if($aa["OutIn"] == "5"):
            $overtime_out = $aa["Time"];
            $my_id = $aa["Time"];
            unset($a[$my_id]);
        endif;
    endforeach;


    $TimeArray[0]["date"] = $a["Date"];
    $TimeArray[0]["time_in_am"] = $time_in_am;
    $TimeArray[0]["time_out_am"] = $time_out_am;
    $TimeArray[0]["time_in_pm"] = $time_in_pm;
    $TimeArray[0]["time_out_pm"] = $time_out_pm;
    $TimeArray[0]["overtime_in"] = $overtime_in;
    $TimeArray[0]["overtime_out"] = $overtime_out;
    $TimeArray[0]["number_lates"] = 0;
    $TimeArray[0]["minutes_lates"] = 0;
    // dump($TimeArray);
    return($TimeArray);
}



?>