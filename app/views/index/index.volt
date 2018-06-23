<section class="content-header">
    <h1>
        Пыщь инфо УПРАВЛЕНИЕ!!
        <small>Хуйня гавно</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Пыщь инфо</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<div class="row">
    <div class="col-md-12">
        <div class="center-wrap">
        </div>
        <div class="text-center">
            <img class="img-fluid img-thumbnail" src="/main/img/slide-3.jpg"  alt="">
        </div>
    </div>
</div>


<style>
    .highcharts-point-hover {
        stroke: rgb(204, 248, 243);
        stroke-width: 1px;
    }
</style>

<script>

    var data = {{ projectTree }};

    console.log(data);
    data = data.objectdb;


    /*Highcharts.chart('container', {
        tooltip: { enabled: false },
        chart:{ backgroundColor: 'transparent'},
        series: [{
            type: 'wordcloud',
            data: data,
            name: 'Occurrences'

        }],
        title: {
            text: ''
        }
    });*/
</script>


