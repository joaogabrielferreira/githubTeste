<!--<?php
    phpinfo(); //mostra as informações do php
?>-->

<!--<?php 
    print ("este é um teste PHP"); //texto que vai aparecer na tela
?>-->

<!--<?php 
    print ("este é um teste PHP<br>");
    echo ("este é o teste 2");
?>-->

<!--<?php 
    $texto01 = "primeiro texto do script"; //criando uma variável
    print ($texto01); //escrevendo o que está escrito na variável
?>-->

<!--<?php 
    $texto01 = "primeiro texto do script"; //aqui escrevi o primeiro texto 
    print ($texto01); 
?>-->

<!--<?php 
    $texto01 = "primeiro texto do script"; //aqui escrevi o primeiro texto
    print ($texto01); //print ("texto02");
?>-->

<!--<?php 
    $texto01 = "primeiro texto do script"; //aqui escrevi o primeiro texto
    print ("$texto01"); 
    //print ("texto02");
    /*comentário mais longo 
    comentário mais longo 
    comentário mais longo*/ 
?>-->

<!--<?php 
    $texto01 = "primeiro texto do script";
    print ('<span style="color:red">'.$texto01.'</span>'); //mudando a cor do texto
    //print ("texto02");
    /*comentário mais longo 
    comentário mais longo 
    comentário mais longo*/ 
?>-->

<!--<?php
    $texto01 = "primeiro texto do script";
    print ("<span style=\"color:#00FFFF;font-size:50px;\">$texto01</span>"); //aqui está mudando a cor e o tamanho da fonte
    //print ("texto02");
    /*comentário mais longo 
    comentário mais longo 
    comentário mais longo*/ 
?>-->

<!--<?php 
    $raw = '22.11.1968'; 
    $start = DateTime::createFromFormat('d.m.Y',$raw); 
    echo "Data de inicio: ".$start->format('Y-m-d')."\n";
?>-->

<!--<?php 
    $raw = '22.11.1968'; 
    $start = DateTime::createFromFormat('d.m.Y',$raw); 
    echo "Data de inicio: ".$start->format('Y-m-d')."\n";
    //cria uma cópia de $start e adiciona um mês e 6 dias 
    $end = clone $start;
    $end->add(new DateInterval('P1M6D'));
    $diff = $end->diff($start); 
    echo "Diferença: ".$diff->format('%m mês, %d dias (total: %a dias)')."\n"; 
    //diferença: 1 mês, 6 dias (total: 37 dias) 
?>-->

<!--<?php 
    $raw = '22.11.1968'; 
    $start = DateTime::createFromFormat('d.m.Y',$raw); 
    echo "Data de inicio: ".$start->format('Y-m-d')."\n";
    //cria uma cópia de $start e adiciona um mês e 6 dias 
    $end = clone $start;
    $end->add(new DateInterval('P1M6D'));
    $diff = $end->diff($start); 
    echo "Diferença: ".$diff->format('%m mês, %d dias (total: %a dias)')."\n"; 
    //diferença: 1 mês, 6 dias (total: 37 dias)
    if($start<$end){
        echo "Começa antes do fim!\n";
    }
?>-->

<!--<?php 
    $raw = '22.11.1968'; 
    $start = DateTime::createFromFormat('d.m.Y',$raw); 
    echo "Data de inicio: ".$start->format('Y-m-d')."\n";
    //cria uma cópia de $start e adiciona um mês e 6 dias 
    $end = clone $start;
    $end->add(new DateInterval('P1M6D'));
    $diff = $end->diff($start); 
    echo "Diferença: ".$diff->format('%m mês, %d dias (total: %a dias)')."\n"; 
    //diferença: 1 mês, 6 dias (total: 37 dias)
    if($start<$end){
        echo "Começa antes do fim!\n";
    }
    //mostra todas as quintas-feiras entre $start e $end 
    $periodInterval = DateInterval::createFromDateString('first thursday'); 
    $periodIterator = new DatePeriod($start, $periodInterval, $end, 
    DatePeriod::EXCLUDE_START_DATE); 
    foreach($periodIterator as $date) {     
    //mostra cada data no período     
    echo $date->format('d-m-Y'). ""; 
    } 
?>-->