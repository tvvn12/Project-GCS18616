$(document).ready(function()
{
    $('.razorpay_btn').click(function (e){
        e.preventDefault();
        var firstname  = $('.firstname').val();
       var lastname = $('.lastname').val();
       var email = $('.email').val();
      var  phone = $('.phone').val();
      var  address1 = $('.address1').val();
      var  address2 = $('.address2').val();
      var  city = $('.city').val();
      var  state = $('.state').val();
      var  country = $('.country').val();
      var  pincode = $('.pincode').val();
           
        if(!firstname)
        {
            fname_error = " The field not be empty ";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        }
        else{
            fname_error= "";
            $('#fname_error').html('');
           
        }

        if(!lastname)
        {
            lastname_error = "  The field not be empty ";
            $('#lastname_error').html('');
            $('#lastname_error').html(lastname_error);
        }
        else{
            lastname_error= "";
            $('#lastname_error').html('');
           
        }
        if(!email)
        {
            email_error = "  The field not be empty ";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        }
        else{
            email_error= "";
            $('#email_error').html('');
           
        }
        if(!phone)
        {
            phone_error = "  The field not be empty ";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        }
        else{
            phone_error= "";
            $('#phone_error').html('');
           
        }


        if(!address1)
        {
            address1_error = "  The field not be empty ";
            $('#address1_error').html('');
            $('#address1_error').html(address1_error);
        }
        else{
            address1_error= "";
            $('#address1_error').html('');
           
        }
        if(!address2)
        {
            address2_error = "  The field not be empty ";
            $('#address2_error').html('');
            $('#address2_error').html(address2_error);
        }
        else{
            address2_error= "";
            $('#address2_error').html('');
           
        }

        if(!city)
        {
            city_error = "  The field not be empty ";
            $('#city_error').html('');
            $('#city_error').html(city_error);
        }
        else{
            city_error= "";
            $('#city_error').html('');
           
        }

        if(!state)
        {
            state_error = "  The field not be empty ";
            $('#state_error').html('');
            $('#state_error').html(state_error);
        }
        else{
            state_error= "";
            $('#state_error').html('');
           
        }

        if(!country)
        {
            country_error = " The field not be empty ";
            $('#country_error').html('');
            $('#country_error').html(country_error);
        }
        else{
            country_error= "";
            $('#country_error').html('');
           
        }

        if(!pincode)
        {
            pincode_error = "  The field not be empty ";
            $('#pincode_error').html('');
            $('#pincode_error').html(pincode_error);
        }
        else{
            pincode_error= "";
            $('#pincode_error').html('');
           
        }

        if(fname_error != ''|| lastname_error !='' || email_error != ''|| phone_error!=''|| address1_error !=''|| address2_error !=''|| city_error!=''|| state_error!=''|| country_error!=''||pincode_error!='' )
        {
            return false;
        }
        else{
            var data={
                 'firstname':  firstname,
                 'lastname':  lastname,
                 'email':  email,
                 'phone':  phone,
                  'address1':  address1,
                  'address2':  address2,
                  'city':  city,
                  'state':  state,
                  'country':  country,
                  'pincode':  pincode

            }

            $.ajax({
                method:"POST",
                url : "/proceed-to-pay",
                data : data,
                
                success: function(response){
                    // alert(response.total_price)
                    var options = {
                        "key": "rzp_test_YUsTJmlePJYtlQ", // Enter the Key ID generated from the Dashboard
                        "amount": 2*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "USD",
                        "name": response.firstname+''+  response.lastname,
                        "description": "Thank you",
                        "image": "https://scontent.fsgn2-6.fna.fbcdn.net/v/t31.18172-8/28698850_815418011986491_1647591906271578689_o.jpg?_nc_cat=111&ccb=1-5&_nc_sid=cdbe9c&_nc_ohc=B_D_bSapvSIAX8kr8H9&_nc_ht=scontent.fsgn2-6.fna&oh=c58507d38b9aa392e8797d60407a93c5&oe=61A71516",
                        // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (responsea){
                            // alert(responsea.razorpay_payment_id);
                            $.ajax({
                                method:"POST",
                                url:"/place-order",
                                data:{
                                   'fname' :response.firstname,
                                   'lname' :response.lastname,
                                   'email' :response.email,
                                   'phone' :response.phone,
                                   'address1' :response.address1,
                                   'address2' :response.address2,
                                   'city' :response.city,
                                   'state' :response.state,
                                   'country' :response.country,
                                   'pincode' :response.pincode,
                                   'payment_mode':"Pay by Razor",
                                   'payment_id':responsea.razorpay_payment_id,


                                   
                                },
                               
                                success: function(responseb)
                                {
                                    // alert(responseb.status);
                                    swal(responseb.status);
                                    window.setTimeout(function(){location.href ="/my-orders"},3000);
                                    
                                }
                            });
                           
                        },
                        "prefill": {
                            "name": response.firstname+''+  response.lastname,
                            "email": response.email,
                            "contact": response.phone
                        },
                        
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                     rzp1.open();
                     
                    

                }

                });
        }
        
    });

});