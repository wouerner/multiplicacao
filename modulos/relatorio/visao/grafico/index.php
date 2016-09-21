<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>
    <body>
        <section class = "container-fluid">
            <nav>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
            <section>
                <article>
                    <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
                    <div class = "row-fluid" >
                        <div class = "span12" >
                            <div id="crescimentoChart"></div>
                            <div id="redesChart"></div>
                            <div id="statusChart"></div>
                            <script>
                                var keys;

                                jQuery.get('/relatorio/grafico/crescimento')
                                                .done(function( data ) {

                                    keys = Object.keys(data);
                                    //console.log(keys);
                                    keys.unshift("x");
                                    //console.log(keys);

                                    var arr = [];
                                    jQuery.each(data, function(key, value){
                                        arr.push(value);
                                    });
                                    //console.log(arr);
                                    arr.unshift("data");

                                    var chart = c3.generate({
                                        bindto: '#crescimentoChart',
                                        data: {
                                            x: 'x',
                                            xFormat: '%d-%m-%Y', // 'xFormat' can be used as custom format of 'x'
                                            columns: [
                                                keys, //['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
                                    //            ['x', '20130101', '20130102', '20130103', '20130104', '20130105', '20130106'],
                                                arr, //['data1', 30, 200, 100, 400, 150, 250],
                                            ]
                                        },
                                        axis: {
                                            x: {
                                                type: 'timeseries',
                                                tick: {
                                                    format: '%Y-%m-%d'
                                                }
                                            }
                                        }
                                    });
                                });

                                jQuery.get('/relatorio/grafico/crescimentoRedes')
                                                .done(function( data ) {
                                    console.log(data);

                                    var chart2 = c3.generate({
                                        bindto: '#redesChart',
                                        data: {
                                            x: 'x',
                                            xFormat: '%d-%m-%Y', // 'xFormat' can be used as custom format of 'x'
                                            columns:// [
                                             //  ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
                                    //            ['x', '20130101', '20130102', '20130103', '20130104', '20130105', '20130106'],
                                                data, //['data1', 30, 200, 100, 400, 150, 250],
                                            //]
                                        },
                                        axis: {
                                            x: {
                                                type: 'timeseries',
                                                tick: {
                                                    format: '%Y-%m-%d'
                                                }
                                            }
                                        }
                                    });
                                });

                                jQuery.get('/relatorio/grafico/crescimentoStatus')
                                                .done(function( data ) {
                                    console.log(data);

                                    var chart3 = c3.generate({
                                        bindto: '#statusChart',
                                        data: {
                                            x: 'x',
                                            xFormat: '%d-%m-%Y', // 'xFormat' can be used as custom format of 'x'
                                            columns:// [
                                             //  ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
                                    //            ['x', '20130101', '20130102', '20130103', '20130104', '20130105', '20130106'],
                                                data, //['data1', 30, 200, 100, 400, 150, 250],
                                            //]
                                        },
                                        axis: {
                                            x: {
                                                type: 'timeseries',
                                                tick: {
                                                    format: '%Y-%m-%d'
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </article>
            </section>
        </section>
    </body>
</html>
