    
document.addEventListener('DOMContentLoaded', (event) => {
    const hamburger = document.getElementById('hamburger');
    const main = document.getElementById('main');
    const sidebar = document.querySelector('.nav-sidebar');
    const profile = document.querySelector('.header-nav-item');
    const ndropdown = document.querySelector('.nav-dropdown');


    hamburger.addEventListener('click', () =>{
        sidebar.classList.toggle('nav-sidebar-open');
    });

    profile.addEventListener('click', () => {
        ndropdown.classList.toggle('active');
    });
    main.addEventListener('click', () =>{
        // if(sidebar.classList.contains('nav-sidebar-open')){
            sidebar.classList.remove('nav-sidebar-open');
        
    });

    $('#myTab a').on('click', function (e) {
        e.preventDefault()
        console.log('hie');
        $(this).tab('show')
    })

    // Show search dropdown
    const search = $('#search');
    const search_result = $('.search-result');
    search.on('input', ()=>{
        search.addClass('no-bottom-borders');
        $('.search-result').css('display','block');
        let terms = search.val();
        const url = `/customer/${terms}/search`;
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function(){
                search_result.html('loading...');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response))
                let ul = '<ul class="list-group list-group-flush">';
                $.each(data, (key, value) => {
                    $.each(value, (index, item)=>{
                        console.log(item);
                        ul += `<li class="list-group list-group-item">
                                   <a href="#">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6>${item.firstname}  ${item.surname}</h6>
                                        <small>${item.phone}</small>
                                    </div>
                                    <p class="mb-1">${item.email}</p> 
                                    </a>
                                </li>`;
                    });
                });
                ul += '</ul>';
                $('.search-result').html(ul);
            },
            error: function(request, error){
                let errors = JSON.parse(request.responseText);
                $('#search-result-list').html('No r');
            }
        });
    });
    // ul += '<li class="list-group list-group-item"><div class="d-flex w-100 justify-content-between"><h6>' + item.firstname + ' ' + item.surname + '</h6><small>'+ item.phone +'</small></div><p class="mb-1">'+ item.email +'</p></li>';
    search.on('blur', ()=>{
        $('#search').removeClass('no-bottom-borders');
        $('.search-result').css('display','none');
    });

    const search_contribution = $('#search-contribution');
    const search_contribution_result = $('.search-contribution-result');
    search_contribution.on('input', ()=>{
        search_contribution.addClass('no-bottom-borders');
        $('.search-result').css('display','block');
        let terms = search_contribution.val();
        const url = `/contributions/${terms}/search`;
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function(){
                search_result.html('<div class="d-flex justify-content-center pt-1 pb-1"><i class="fa fa-spinner fa-spin"></i> &nbsp; Searching...</div>');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response))
                let ul = '<ul class="list-group list-group-flush">';

                if(data !== undefined){
                    $.each(data, (key, value) => {
                        $.each(value, (index, item)=>{
                            ul += `<li class="list-group list-group-item">
                         
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6>${item.phone} </h6>
                                        <small>${item.updated_at}</small>
                                    </div>
                                    <p class="mb-1">${item.pin}</p> 
                                    
                                </li>`;
                        });
                    });
                    ul += '</ul>';
                }else{
                    ul += `<li class="list-group list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                                <p>No result found</p>
                        </div>
                    </li>`;
                    ul += '</ul>';
                }

                $('.search-result').html(ul);
            },
            error: function(request, error){
                let errors = JSON.parse(request.responseText);
                $('#search-result-list').html('No result for this query');
            }
        });
    });
    // ul += '<li class="list-group list-group-item"><div class="d-flex w-100 justify-content-between"><h6>' + item.firstname + ' ' + item.surname + '</h6><small>'+ item.phone +'</small></div><p class="mb-1">'+ item.email +'</p></li>';
    search_contribution.on('blur', ()=>{
        $('#search_contribution').removeClass('no-bottom-borders');
        $('.search-result').css('display','none');
    });


    // Show the edit modal and populate the fields for customer edit
    $('#editModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let customer_id = button.data('customer_id'); // Extract info from data-* attributes
        let firstname = button.data('firstname'); // Extract info from data-* attributes
        let surname = button.data('surname'); // Extract info from data-* attributes
        let email = button.data('email'); // Extract info from data-* attributes
        let phone = button.data('phone'); // Extract info from data-* attributes
        let address = button.data('address'); // Extract info from data-* attributes
        let city = button.data('city'); // Extract info from data-* attributes
        let state = button.data('state'); // Extract info from data-* attributes
        let amount = button.data('amount'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this);

        modal.find('#customer_id').val(customer_id);
        modal.find('#firstname').val(firstname);
        modal.find('#surname').val(surname);
        modal.find('#email').val(email);
        modal.find('#phone').val(phone);
        modal.find('#address').val(address);
        modal.find('#city').val(city);
        modal.find('#state').val(state);
        modal.find('#amount').val(amount);
    });

    $('#editBtn').on('click', (e)=>{
        e.preventDefault();

        // let token = $('#token').val();
        let customer_id = $('#customer_id').val();
        // let firstname = $('#firstname').val();
        // let surname = $('#surname').val();
        // let email = $('#email').val();
        // let phone = $('#phone').val();
        // let address = $('#address').val();
        // let city = $('#city').val();
        // let state = $('#state').val();
        // let amount = $('#amount').val();

        const url = `/customer/${customer_id}/edit`;
        const data = {
            token : $('#token').val(),
            firstname : $('#firstname').val(),
            surname : $('#surname').val(),
            email : $('#email').val(),
            phone : $('#phone').val(),
            address : $('#address').val(),
            city : $('#city').val(),
            state : $('#state').val(),
            amount : $('#amount').val(),
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            beforeSend: function(){
                $('#editBtn').html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
            },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response))
                let message = data.success;
                msg.innerHTML = alertMessage('success', message);
                $('#editBtn').html('Save');
                interval(5000);
            },
            error: function(request, error){

                let errors = JSON.parse(request.responseText);
                console.log(errors);
                let ul = '';
                $.each(errors, (key, value) => {
                    $.each(value, (index, item)=>{
                        console.log(item);
                        ul += `${item} <br>`;
                    });

                });

                msg.innerHTML = alertMessage('danger', ul);
                $('#editBtn').html('Save');
                interval(5000);
            }
        });
    });

    // show the delete confirmation modal
    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let customer_id = button.data('customer_id'); // Extract info from data-* attributes
        let form_action = `/customer/${customer_id}/delete`;

        let modal = $(this)
        modal.find('#customerDeleteForm').attr("action", form_action);
    });

    $('#deleteCustomerBtn').on('click', (e)=>{
        e.preventDefault();
        $("#customerDeleteForm").submit();
    });


    function alertMessage(status, message){
        return `<div class="alert alert-${status} m-t-20 alert-dismissible fade show" role="alert">
	${message}
	</div>`;
    }

    function interval(duration){
        setTimeout(()=>{
            $(".alert").alert('close');
        }, duration);
    }

    // Daily contribution chart
    let ctx = $('#contribution-canvas');
    function contribution_chart(chart_data){
        let label_list = [];
        let data_list = [];
        for(let i = 0; i < chart_data.length; i++){
            label_list.push(new Date(chart_data[i].created_at).toLocaleDateString());
            data_list.push(chart_data[i].daily_total);
        }
        console.log(label_list, data_list);
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: label_list,
                datasets: [{
                    data: data_list,
                    label: "",
                    backgroundColor: 'rgba(0, 92, 230, .5)',
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#007bff',
                    borderColor: [
                        '#4361EE',
                    ],
                    borderWidth: 2,

                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            // max: Math.max.apply(this, pin_data) + 100
                        }
                    }],
                    // xAxes: [{
                    //     type: 'time',
                    //     time: {
                    //         parser: 'YYYY-MM-DD HH:mm:ss',
                    //         unit: 'day',
                    //         displayFormats: {
                    //             quarter: 'MMM D'
                    //         },
                    //         max: d,
                    //         min: i7,
                    //
                    //     },
                    //     ticks: {
                    //         source: 'data'
                    //     }
                    // }]
                },
                legend: {
                    display: false
                },
                hover: {
                    animationDuration: 0,
                },
                responsiveAnimationDuration: 0
            },
            // plugins: [{
            //     beforeInit: function(chart) {
            //         var time = chart.options.scales.xAxes[0].time, // 'time' object reference
            //             timeDiff = moment(time.max).diff(moment(time.min), 'd'); // difference (in days) between min and max date
            //         // populate 'labels' array
            //         // (create a date string for each date between min and max, inclusive)
            //         for (i = 0; i <= timeDiff; i++) {
            //             var _label = moment(time.min).add(i, 'd').format('YYYY-MM-DD HH:mm:ss');
            //             chart.data.labels.push(_label);
            //         }
            //     }
            // }]
        });
        // let pin_data = [30, 12, 20, 27, 50, 25, 33, 42, 22, 61];

        // let pin_usage = new Chart(ctx, {
        //     type: 'line',
        //     data:{
        //         // labels: ['Red', 'green', 'blue', 'yellow', 'orange', 'Purple','blue', 'yellow', 'orange', 'Purple'],
        //         datasets: [{
        //             label: '',
        //             data: pin_data,
        //             backgroundColor: 'rgba(0, 92, 230, .5)',
        //             pointBackgroundColor: '#ffffff',
        //             pointBorderColor: '#007bff',
        //             borderColor: [
        //                 '#4361EE',
        //             ],
        //             borderWidth: 2,
        //             // data: [{
        //             //     t: new Date(),
        //             //     x: 10
        //             // }]
        //         }]
        //
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero: true,
        //                     // max: Math.max.apply(this, pin_data) + 100
        //                 }
        //             }],
        //             xAxes: [{
        //                 type: 'time',
        //                 time: {
        //                     unit: 'day',
        //                     displayFormats: {
        //                         quarter: 'MMM D'
        //                     },
        //
        //                 },
        //                 ticks: {
        //                     source: 'data',
        //                     min: d,
        //                     max: moment(d).subtract(7 , 'day'),
        //                 }
        //             }]
        //         }
        //     },
        //     plugins: [{
        //         beforeInit: function(chart) {
        //             let time = chart.options.scales.xAxes[0].ticks, // 'time' object reference
        //                 timeDiff = moment(time.max).diff(moment(time.min), 'd'); // difference (in days) between min and max date
        //             // populate 'labels' array
        //             // (create a date string for each date between min and max, inclusive)
        //             for (let i = 0; i <= timeDiff; i++) {
        //                 let _label = moment(time.min).add(i, 'd').format('YYYY-MM-DD HH:mm:ss');
        //                 chart.data.labels.push(_label);
        //             }
        //         }
        //     }]
        // });
    }
    if(ctx.length){console.log('The ajax call should go');
        const url = `/dashboard/chart`;
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function(){

            },
            success: function (response) {
                let chart_data = JSON.parse(response);
                console.log(chart_data.contribution_count);
                contribution_chart(chart_data.contribution_count);
            },
            error: function(request, error){
                let errors = JSON.parse(request.responseText);
                console.log(errors);
            }
        });


    }

    let channel_ctx = $('#channel-canvas');
    function channel_usage_chart(){

        let pin_data = [40, 5];
        let pin_usage = new Chart(channel_ctx, {
            type: 'doughnut',
            data:{
                labels: ['USSD', 'Web'],
                datasets: [{
                    label: 'Daily Contributions',
                    data: pin_data,
                    backgroundColor: ['#3A0CA3', '#F72585'],
                    pointBackgroundColor: '#ff00ff',
                    pointBorderColor: '#007bff',
                    borderColor: [
                        '#4361EE',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {

                }
            }
        });
    }
    if(channel_ctx.length){
        channel_usage_chart()
    }
    function pin_analysis_chart(){

        let pin_data = [300, 124, 200, 287, 500, 250, 330, 222, 140, 413];
        let pin_data2 = [1, 9, 12, 4, 10, 30, 3, 22, 8, 7];

        let pin_usage = new Chart(ctx, {
            type: 'line',
            data:{
                labels: ['Red', 'green', 'blue', 'yellow', 'orange', 'Purple','blue', 'yellow', 'orange', 'Purple'],
                datasets: [{
                    label: 'Daily Contributions',
                    data: pin_data,
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#007bff',
                    borderColor: [
                        '#4361EE',
                    ],
                    borderWidth: 2
                },
                    {
                        label: 'Pin used',
                        data: pin_data2,
                        backgroundColor: 'transparent',
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#f72585',
                        borderColor: [
                            '#f72585',
                        ],
                        borderWidth: 2
                    }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: Math.max.apply(this, pin_data) + 2
                        }
                    }]
                }
            }
        });
    }


});