<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 8 Vue 3 Demo</title>
    <!-- <script src="js/app.js"></script> -->
</head>
<body>
    <h1>Hello Indy</h1>

    <div id="app">

        <hello-world foo="Take me to your leader!"></hello-world>

        @php
    
    $data3 = [
             ['label' => 'Athlete', 'color' => '#217ca3', 'values' => [16, 271, 268, 258, 211]],
             ['label' => 'NonAthlete', 'color' => '#8d230f', 'values' => [748, 640, 883, 1394, 374]]
    ];
    /* 
    $length3 = count($data3);
    $total3 = [];
    for ($i = 0; $i < 5; $i++)
    {
        $total3[] = $data3[0]['values'][$i] + $data3[1]['values'][$i]; 
    }
    $labels3 = ['Total', $data3[0]['label'], $data3[1]['label']];
    $numbers3 = [$total3, $data3[0]['values'], $data3[1]['values']];
   */
   
    $series3 = [
        'title' => 'Number of Applications - TRAD Programs',
        'categories' => ['Fall 2017', 'Fall 2018', 'Fall 2019', 'Fall 2020', 'Fall 2021'],
        'data' => $data3,
    ];
    @endphp
        <h2>Figure 3 - TRAD Applications by Athletic Status</h2>
        <stacked-column-with-data-label-percents
            :series='@json($series3)'>
        ></stacked-column-with-data-label-percents>
    </div>

    <script src="js/app.js"></script>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
</body>
</html>