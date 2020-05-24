const days = [
    'Sunday',
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday'
];

const months = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
]
let clock = new Date();
let day = clock.getDay();
let date = clock.getDate();
let month = clock.getMonth();
let dayActual = '';
let monthActual = '';

for (let i = 0; i <= day; i++) {
    dayActual = days[i]
};

for (let i = 0; i <= month; i++) {
    monthActual = months[i]
};

var app = new Vue({
    el: '#date',
    data: {
        message: dayActual + ', ' + monthActual + ' ' + date
    }
});