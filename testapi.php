<?php

    /*

        API DOC:

        methods:

        GET /testapi.php?action=get_colors
        get aviable colors
        params: no

        GET /testapi.php?action=get_cows
        return list of cows
        params:
            filter_color: id of color
            filter_milk_avg_min: minimum age
            filter_milk_avg_max: maximum age

            order_by: order by [name/bdate/color/milk_avg/age]
            order_dir: order direction [ASC/DESC] (ASC by default)

     */

    $on_page = 10;
    $page = 0;

    $colors = Array(
        1=>'White',
        2=>'Black',
        3=>'White/Black',
        4=>'Brown',
        5=>'Red',
    );

    $database = Array(
        Array('name'=>'Alise', 'bdate'=>'2020-02-15', 'color_id'=>1, 'milk_avg'=>5),
        Array('name'=>'Rachel', 'bdate'=>'2021-03-10', 'color_id'=>1, 'milk_avg'=>5.5),
        Array('name'=>'Amely', 'bdate'=>'2020-02-15', 'color_id'=>1, 'milk_avg'=>3),
        Array('name'=>'Sidney', 'bdate'=>'2021-04-01', 'color_id'=>1, 'milk_avg'=>4),
        Array('name'=>'Monroe', 'bdate'=>'2021-05-03', 'color_id'=>1, 'milk_avg'=>4.1),
        Array('name'=>'Natasha', 'bdate'=>'2021-04-13', 'color_id'=>1, 'milk_avg'=>4.2),
        Array('name'=>'Konfetka', 'bdate'=>'2019-02-11', 'color_id'=>1, 'milk_avg'=>4.3),
        Array('name'=>'Lusya', 'bdate'=>'2019-03-11', 'color_id'=>1, 'milk_avg'=>4),
        Array('name'=>'Galya', 'bdate'=>'2020-02-15', 'color_id'=>2, 'milk_avg'=>4.2),
        Array('name'=>'Maryna', 'bdate'=>'2019-01-11', 'color_id'=>2, 'milk_avg'=>4.7),
        Array('name'=>'Kitty', 'bdate'=>'2019-01-10', 'color_id'=>2, 'milk_avg'=>4.3),
        Array('name'=>'Antuanetta', 'bdate'=>'2019-02-01', 'color_id'=>3, 'milk_avg'=>4.2),
        Array('name'=>'Agrofena', 'bdate'=>'2021-03-18', 'color_id'=>3, 'milk_avg'=>4.9),
        Array('name'=>'Makarena', 'bdate'=>'2021-02-01', 'color_id'=>3, 'milk_avg'=>4.2),
        Array('name'=>'Korovaya', 'bdate'=>'2018-04-05', 'color_id'=>3, 'milk_avg'=>5.1),
        Array('name'=>'Ingrid', 'bdate'=>'2018-09-17', 'color_id'=>4, 'milk_avg'=>5.2),
        Array('name'=>'Misty', 'bdate'=>'2019-09-19', 'color_id'=>4, 'milk_avg'=>4.7),
        Array('name'=>'Jeniffer', 'bdate'=>'2019-08-10', 'color_id'=>4, 'milk_avg'=>4.3),
        Array('name'=>'Lousia Fernanda', 'bdate'=>'2019-09-19', 'color_id'=>4, 'milk_avg'=>4.7),
        Array('name'=>'Amalia', 'bdate'=>'2019-10-19', 'color_id'=>4, 'milk_avg'=>4.8),
        Array('name'=>'Sahsa Gray', 'bdate'=>'2021-01-01', 'color_id'=>4, 'milk_avg'=>4.2),
        Array('name'=>'Shaherizada', 'bdate'=>'2021-10-12', 'color_id'=>4, 'milk_avg'=>4.2),
        Array('name'=>'Angelina', 'bdate'=>'2021-11-22', 'color_id'=>4, 'milk_avg'=>4.1),
        Array('name'=>'Tavifa', 'bdate'=>'2019-12-19', 'color_id'=>5, 'milk_avg'=>4.7),
        Array('name'=>'Lora', 'bdate'=>'2020-03-15', 'color_id'=>2, 'milk_avg'=>4.2),
        Array('name'=>'Manya', 'bdate'=>'2019-04-11', 'color_id'=>2, 'milk_avg'=>4.7),
        Array('name'=>'Bebe', 'bdate'=>'2019-12-10', 'color_id'=>2, 'milk_avg'=>4.3),
        Array('name'=>'Zoya', 'bdate'=>'2019-11-01', 'color_id'=>3, 'milk_avg'=>4.2),
        Array('name'=>'Vika', 'bdate'=>'2021-07-18', 'color_id'=>3, 'milk_avg'=>4.9),
        Array('name'=>'Kate', 'bdate'=>'2021-05-01', 'color_id'=>3, 'milk_avg'=>4.2),
        Array('name'=>'Rosa', 'bdate'=>'2018-06-05', 'color_id'=>3, 'milk_avg'=>5.1),
        Array('name'=>'Khloe', 'bdate'=>'2018-10-17', 'color_id'=>4, 'milk_avg'=>5.2),
        Array('name'=>'Busina', 'bdate'=>'2020-02-15', 'color_id'=>1, 'milk_avg'=>3),
        Array('name'=>'Milka', 'bdate'=>'2021-04-01', 'color_id'=>1, 'milk_avg'=>4),
        Array('name'=>'Burionka', 'bdate'=>'2021-05-03', 'color_id'=>1, 'milk_avg'=>4.1),
        Array('name'=>'Nastya', 'bdate'=>'2021-04-13', 'color_id'=>1, 'milk_avg'=>4.2),
        Array('name'=>'Varya', 'bdate'=>'2019-02-11', 'color_id'=>1, 'milk_avg'=>4.3),
        Array('name'=>'Batty', 'bdate'=>'2020-02-17', 'color_id'=>2, 'milk_avg'=>4.2),
        Array('name'=>'Khloe', 'bdate'=>'2019-01-12', 'color_id'=>2, 'milk_avg'=>4.7),
        Array('name'=>'Izolda', 'bdate'=>'2019-09-11', 'color_id'=>2, 'milk_avg'=>4.3),
        Array('name'=>'Karmellita', 'bdate'=>'2019-05-11', 'color_id'=>3, 'milk_avg'=>4.2),
        Array('name'=>'Ester', 'bdate'=>'2020-02-15', 'color_id'=>1, 'milk_avg'=>5),
        Array('name'=>'Kamilla', 'bdate'=>'2021-03-10', 'color_id'=>1, 'milk_avg'=>5.5),
        Array('name'=>'Maluka', 'bdate'=>'2020-02-15', 'color_id'=>1, 'milk_avg'=>3),
        Array('name'=>'Zara', 'bdate'=>'2021-04-01', 'color_id'=>1, 'milk_avg'=>4),
        Array('name'=>'Guccia', 'bdate'=>'2021-05-03', 'color_id'=>1, 'milk_avg'=>4.1),
        Array('name'=>'Stefania', 'bdate'=>'2021-04-01', 'color_id'=>1, 'milk_avg'=>4),
        Array('name'=>'Scally', 'bdate'=>'2021-05-03', 'color_id'=>1, 'milk_avg'=>4.1),
        Array('name'=>'Rebecca', 'bdate'=>'2021-04-13', 'color_id'=>1, 'milk_avg'=>4.2),
        Array('name'=>'Louise', 'bdate'=>'2019-02-11', 'color_id'=>1, 'milk_avg'=>4.3),
        Array('name'=>'Konchita', 'bdate'=>'2020-02-17', 'color_id'=>2, 'milk_avg'=>4.2),
        Array('name'=>'Lara', 'bdate'=>'2019-01-12', 'color_id'=>2, 'milk_avg'=>4.7),
        Array('name'=>'Mica', 'bdate'=>'2019-09-11', 'color_id'=>2, 'milk_avg'=>4.3),
        Array('name'=>'Bonya', 'bdate'=>'2019-05-11', 'color_id'=>3, 'milk_avg'=>4.2),
        Array('name'=>'Morgana', 'bdate'=>'2020-02-15', 'color_id'=>1, 'milk_avg'=>5),
        Array('name'=>'Polina', 'bdate'=>'2021-03-10', 'color_id'=>1, 'milk_avg'=>5.5),
        Array('name'=>'Mirabella', 'bdate'=>'2020-02-15', 'color_id'=>1, 'milk_avg'=>3),
        Array('name'=>'Victoria', 'bdate'=>'2021-04-01', 'color_id'=>1, 'milk_avg'=>4),
        Array('name'=>'Anneta', 'bdate'=>'2021-05-03', 'color_id'=>1, 'milk_avg'=>4.1),


    );

    if(isset($_GET['action'])){

        if(isset($_GET['page'])){
            $page = intval($_GET['page']);
        }

        if($_GET['action'] == 'get_colors'){
            echo json_encode($colors);
        }

        if($_GET['action'] == 'get_cows'){

            $final = Array();

            foreach($database as $data){

                $add = true;

                if(isset($_GET['filter_color'])){
                    if($data['color_id'] != $_GET['filter_color']){
                        $add = false;
                    }
                }

                //filter_milk_avg_min: minimum age
                //filter_milk_avg_max: maximum age

                if(isset($_GET['filter_milk_avg_min'])){
                    if($data['milk_avg'] <= $_GET['filter_milk_avg_min']*1){
                        $add = false;
                    }
                }

                if(isset($_GET['filter_milk_avg_max'])){
                    if($data['milk_avg'] >= $_GET['filter_milk_avg_max']*1){
                        $add = false;
                    }
                }

                if($add){

                    $data['color'] = $colors[$data['color_id']];
                    $date1 = new DateTime($data['bdate']);
                    $date2 = new DateTime(date('y-m-d'));
                    $interval = $date1->diff($date2);
                    $data['age'] = $interval->y;

                    $final[] = $data;

                }

            }

            if(isset($_GET['order_by'])){

                $SORT = SORT_ASC;

                if(isset($_GET['order_dir']) && $_GET['order_dir'] == 'DESC'){
                    $SORT = SORT_DESC;
                }

                array_multisort( array_column($final, $_GET['order_by']), $SORT, $final);

            }

            echo json_encode(Array('data'=>array_slice($final, $page * $on_page, $on_page), 'total'=> count($final), 
            'on_page'=> $on_page));

        }

    }
