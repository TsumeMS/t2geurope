$(() => {
    const control = $('#control');
    const intervals = [];
    control.on('click', () => {
        if(control.text() === 'Start') {
            const values = getValues();
            const interval = setInterval(() => {
                setValues(values);
                values.seconds--;
                if(values.seconds < 0 && values.minutes >= 0) {
                    values.minutes--;
                    values.seconds = 59;
                } else if(values.minutes < 0 && values.hours >= 0) {
                    values.hours--;
                    values.minutes = 59;
                } else if(values.hours < 0 && values.days > 0) {
                    values.days--;
                    values.hours = 24;
                }
                if(values.days === 0 && values.hours === 0 && values.minutes === 0 && values.seconds === 0){
                    setValues(values);
                    clearintervals(intervals);
                }
            }, 1000);
            control.text('Stop');
            intervals.push(interval);
        } else {
            control.text('Start');
            clearintervals(intervals);
        }
    })
});

function getValues() {
    return {
        days: parseInt($('#counter-days').val()),
        hours: parseInt($('#counter-hours').val()),
        minutes: parseInt($('#counter-minutes').val()),
        seconds: parseInt($('#counter-seconds').val())
    }
}

function setValues(values) {
    if(values.days > 0) {
        $('#first').find('span').text(values.days);
        $('#first-name').text('days');
        $('#second').find('span').text(values.hours);
        $('#second-name').text('hours');
        $('#third').find('span').text(values.minutes);
        $('#third-name').text('minutes');
    } else {
        $('#first').find('span').text(values.hours);
        $('#first-name').text('hours');
        $('#second').find('span').text(values.minutes);
        $('#second-name').text('minutes');
        $('#third').find('span').text(values.seconds);
        $('#third-name').text('seconds');
    }
}

function clearintervals(intervals) {
    for (let interval of intervals) {
        clearInterval(interval);
    }
}
