const ctx = document.getElementById('myChart').getContext("2d");

const labels = [
    '1月',
    '2月',
    '3月',
    '4月',
    '5月',
    '6月',
    '7月',
    '8月',
    '9月',
    '10月',
    '11月',
    '12月',
];

const data = {
    labels,
    datasets: [
        {
        data: [80.2, 95, 77, 105, 120, 89.6, 80.2, 95, 77, 105, 120, 89.6],
        label: "電子書月銷售額" //銷售額
        },
    ],    
};
const config = {
    type: 'line',
    data: data,
    options:{
        responsive:true,
    },
};

const myChart = new Chart (ctx, config);