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
    dataSets: [{
        data: [] //銷售額
    }]
}