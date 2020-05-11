    
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
                        ul += '<li class="list-group list-group-item">' + item.firstname + ' ' + item.surname + '</li>';
                    });
                });
                ul += '</ul>'
                $('.search-result').html(ul);
            },
            error: function(request, error){
                let errors = JSON.parse(request.responseText);
                $('#search-result-list').html('No r');
            }
        });
    });

    search.on('blur', ()=>{
        $('#search').removeClass('no-bottom-borders');
        $('.search-result').css('display','none');

    })




    // Show the edit modal and populate the fields for customer edit
    $('#editModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
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
        let modal = $(this)

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
        }



        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                let data = JSON.parse(response);
                console.log(JSON.parse(response))
                let message = data.success;
                msg.innerHTML = alertMessage('success', message);
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
        // const data = {
        //     token : $('#token').val(),
        //
        // }

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
});