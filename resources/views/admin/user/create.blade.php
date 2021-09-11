<!-- Modal add -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="Modal_add_user" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_add_user" action="{{route('user.store')}}" method="post">
        <div class="modal-body">

            @csrf
            <div class="form-group">
              <label for="name">Họ tên</label>
              <input type="text" class="form-control" id="name" placeholder="Nhập tên" name="username" required>
            </div>
            <div class="form-group">
              <label for="InputEmail1" >Email address</label>
               <input id="email" type="email" class="form-control" name="email" required autocomplete="email">

            </div>
            <div class="form-group">
              <label for="InputPassword1">Password</label>
              <input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="password" required>
            </div>

        </div>
        <div class="modal-footer">
          <button id="submit_add_user" type="submit" class="btn btn-success btn-sm">Thêm</button>
        </div>
      </form>

    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var startTimer;
        $('#email').on('keyup', function () {
            clearTimeout(startTimer);
            let email = $(this).val();
            startTimer = setTimeout(checkEmail, 500, email);
        });

        $('#email').on('keydown', function () {
            clearTimeout(startTimer);
        });

        function checkEmail(email) {
            $('#email-error').remove();
            if (email.length > 1) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('checkEmail') }}",
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {

                            if (data.success == false) {
                                $('#email').after('<div id="email-error" class="text-danger" <strong>'+data.message[0]+'<strong></div>');

                                $('#submit_add_user').click(function(){
                                    $('#form_add_user').attr('onsubmit','return false;');
                                    $('#email').focus();
                                });

                            } else {
                                $('#email').after('<div id="email-error" class="text-success" <strong>'+data.message+'<strong></div>');
                                $('#submit_add_user').click(function(){
                                    $('#form_add_user').attr('onsubmit','return true;');

                                });
                            }


                    }
                });
            } else {
                $('#email').after('<div id="email-error" class="text-danger" <strong>Email address can not be empty.<strong></div>');
            }
        }
    });
</script>

