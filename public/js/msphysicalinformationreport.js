var graph_data_physical;
window.onload = function () {
    var FORMAT_YYYYMMDD = 'YYYY/MM/DD';
    var FORMAT_YYYYMMDD_PARAM = 'YYYYMMDD';
    $('#range_calendar').daterangepicker({
        singleDatePicker: false,
        showDropdowns: false,
        locale: {
            format: FORMAT_YYYYMMDD,
        },
        startDate: moment().add(-7, 'day'),
        endDate: moment(),
    }, function (start, end, label) {
        var start = moment(start).format(FORMAT_YYYYMMDD_PARAM);
        var end = moment(end).format(FORMAT_YYYYMMDD_PARAM);
        draw_graph_date(start, end);
    });

    // 身体情報報告日付変更時
    $('.target_date').on('change', function (e) {
        $('#form_target_date').val(e.target.value);
        var toDoubleDigits = function (num) {
            num += "";
            if (num.length === 1) {
                num = "0" + num;
            }
            return num;
        };
        var today = new Date(e.target.value);
        var year = today.getFullYear();
        var month = toDoubleDigits(today.getMonth() + 1);
        var day = toDoubleDigits(today.getDate());
        var ymd = year += month += day;
        var report_type = $('#report_type').val();
        var user_id = $('#user_id').val();
        var target_url = '/ms/userinformation/detail/' + report_type + '/?target_date=' + ymd + '&user_id=' + user_id;
        location.href = target_url;
        // console.log(target_url);
        // $.get({
        //     url: target_url,
        //     dataType: 'json', //必須。json形式で返すように設定
        // }).done(function (data) {
        //     //連想配列のプロパティがそのままjsonオブジェクトのプロパティとなっている
        //     // グラフを描画する
            
        //     console.log(data);

        // }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        //     console.log(XMLHttpRequest);
        //     console.log(textStatus);
        //     console.log(errorThrown);
        // })
    });

    var today = moment();
    var default_end_date = today.format('YYYYMMDD');
    var oneweekago = moment();
    oneweekago.add(-7, 'day');
    var default_start_date = oneweekago.format('YYYYMMDD');
    draw_graph_date(default_start_date, default_end_date);

    // 追加ボタン押下時にレポートを追加する
    $('#add-wrapper').on('click', function () {
        // template要素を取得
        var template = document.getElementById('form_template');
        // template要素の内容を複製
        var clone = template.content.cloneNode(true);
        // div#containerの中に追加
        document.getElementById('report_list').appendChild(clone);
        var target_date = $('#target_date').val();
        $('.form_target_date').val(target_date);
    });
    
    $('#add-tr-wrapper').on('click', function () {
        // template要素を取得
        var template = document.getElementById('form_template');
        // template要素の内容を複製
        var clone = template.content.cloneNode(true);
        // div#containerの中に追加
        document.getElementById('report_list').appendChild(clone);
        var target_date = $('#target_date').val();
        $('.form_target_date').val(target_date);
    });

    // 追加ボタン押下時にトレーニング報告内容を追加する
    $('#add_trainning').on('click', function() {
        // template要素を取得
        var template = document.getElementById('trainning_template');
        // template要素の内容を複製
        var clone = template.content.cloneNode(true);
        // div#containerの中に追加
        document.getElementById('trainning_set').appendChild(clone);
        var target_date = $('#target_date').val();
        $('.form_target_date').val(target_date);
    });
}

function draw_graph_date(start, end) {
    var user_id = $('#user_id').val();
    var target_url = '/ms/userinformation/detail/get_graph_data?start_date=' + start + '&end_date=' + end + '&user_id=' + user_id;
    $.get({
        url: target_url,
        dataType: 'json', //必須。json形式で返すように設定
    }).done(function (data) {
        //連想配列のプロパティがそのままjsonオブジェクトのプロパティとなっている
        // グラフを描画する
        draw_physical_information_graph(data);

    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest);
        console.log(textStatus);
        console.log(errorThrown);
    })
}

function draw_physical_information_graph(graph_data_physical) {
    var arr_target_date = [];
    var arr_weight = [];
    var arr_body_fat_percentage = [];
    var arr_muscle_mass = [];
    graph_data_physical.forEach(element => {
        arr_target_date.push(element.DISP_TARGET_DATE);
        arr_weight.push(element.WEIGHT);
        arr_body_fat_percentage.push(element.BODY_FAT_PERCENTAGE);
        arr_muscle_mass.push(element.MUSCLE_MASS);
    });

    var ctx = document.getElementById("physical_chart").getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: arr_target_date,
            datasets: [{
                label: "体重(kg)",
                lineTension: 0,
                fill: false,
                borderColor: 'rgb(255, 0, 0)',
                data: arr_weight,
            },
            {
                label: "体脂肪率(%)",
                lineTension: 0,
                fill: false,
                borderColor: 'rgb(0, 0, 255)',
                data: arr_body_fat_percentage,
            },
            {
                label: "筋肉量(kg)",
                lineTension: 0,
                fill: false,
                borderColor: 'rgb(0, 255, 0)',
                data: arr_muscle_mass,
            },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    ticks: {
                        // fontSize: 18,
                        minRotation: 0, // ┐表示角度水平
                        maxRotation: 0, // ┘
                        maxTicksLimit: 10, // 最大表示数
                        min: 0,      // 最小値
                    },
                }],
                yAxes: [{
                    ticks: {
                        fontSize: 18,
                        min: 0,      // 最小値
                    },
                }],
            },
        }
    });
}

function preview_image(obj) {
    var fileReader = new FileReader();
    fileReader.onload = (function() {
        document.getElementById('preview').src = fileReader.result;
    });
    fileReader.readAsDataURL(obj.files[0]);
}