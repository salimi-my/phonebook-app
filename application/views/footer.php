<footer class="footer">
  <div class="text-center">
    <span class="footer-text">Made with <i class="fas fa-heart"></i> by Salimi</span>
  </div>
</footer>

<!-- JS files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://kit.fontawesome.com/5411e794bf.js" crossorigin="anonymous"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<?php if($this->uri->segment(2) == "" || $this->uri->segment(2) == "contact-list"){ ?>
  <script>
  $(document).ready(function(){
    /*
    * DataTables
    */
    $(document).ready( function () {
      $('#contact_table').DataTable();
    });
    /*
    * Edit button function
    */
    $('.edit-button').click(function(){
      var contact_id = $(this).data('id');
      var contact_name = $(this).data('name');
      var contact_number = $(this).data('number');
      $('#contact_name').val(contact_name);
      $('#phone_number').val(contact_number);
      $('#contact_id').val(contact_id);
      $('#add_form_row').hide();
      $('#edit_form_row').show();
    });
    /*
    * Add new button function
    */
    $('#add_new').click(function(){
      $('#edit_form_row').hide();
      $('#add_form_row').show();
    });
    /*
    * Cancel button function
    */
    $('#update_cancel').click(function(){
      $('#contact_name').val('');
      $('#phone_number').val('');
      $('#contact_id').val('');
      $('#edit_form_row').hide();
      $('#contact_name').removeClass('is-invalid');
      $('#phone_number').removeClass('is-invalid');
      $('#contact_name_error').html('');
      $('#phone_number_error').html('');
    });
    $('#update_cancel2').click(function(){
      $('#contact_name2').val('');
      $('#phone_number2').val('');
      $('#add_form_row').hide();
      $('#contact_name2').removeClass('is-invalid');
      $('#phone_number2').removeClass('is-invalid');
      $('#contact_name2_error').html('');
      $('#phone_number2_error').html('');
    });
    /*
    * Update contact form function
    */
    $('#update_submit').on('click', function(e){
      e.preventDefault();
      $('#update_submit').hide();
      $('#update_loading').show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>contact-list/edit-contact",
        data: $("#edit_form").serialize(),
        dataType: "JSON",
        success: function(data){
          if(data.result == true){
            $('#update_loading').hide();
            $('#update_submitted').show();
            $('#success_message').html(data.success_message);
            $('#success_alert').show();
            location.reload();
          }else{
            $('#update_loading').hide();
            $('#update_submit').show();
            if(data.contact_name_error != '' || data.phone_number_error != ''){
              if(data.contact_name_error != ''){
                $('#contact_name').addClass('is-invalid');
                $('#contact_name_error').html(data.contact_name_error);
              }
              if(data.phone_number_error != ''){
                $('#phone_number').addClass('is-invalid');
                $('#phone_number_error').html(data.phone_number_error);
              }
            }else{
              $('#error_message').html(data.error_message);
              $('#error_alert').show();
            }
          }
        }
      });
    });
    /*
    * Add contact form function
    */
    $('#add_submit').on('click', function(e){
      e.preventDefault();
      $('#add_submit').hide();
      $('#add_loading').show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>contact-list/add-contact",
        data: $("#add_form").serialize(),
        dataType: "JSON",
        success: function(data){
          if(data.result == true){
            $('#add_loading').hide();
            $('#add_submitted').show();
            $('#success_message2').html(data.success_message);
            $('#success_alert2').show();
            location.reload();
          }else{
            $('#add_loading').hide();
            $('#add_submit').show();
            if(data.contact_name_error != '' || data.phone_number_error != ''){
              if(data.contact_name_error != ''){
                $('#contact_name2').addClass('is-invalid');
                $('#contact_name2_error').html(data.contact_name_error);
              }
              if(data.phone_number_error != ''){
                $('#phone_number2').addClass('is-invalid');
                $('#phone_number2_error').html(data.phone_number_error);
              }
            }else{
              $('#error_message2').html(data.error_message);
              $('#error_alert2').show();
            }
          }
        }
      });
    });
    /*
    * Delete contact function
    */
    var selected_contact = '';
    $('.delete-button').click(function(){
      selected_contact = $(this).data('id');
      $('#delete_contact_modal').modal('show');
    });
    $('#delete_contact_submit').on('click', function(e){
      e.preventDefault();
      $('#delete_contact_submit').hide();
      $('#delete_contact_loading').show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>contact-list/delete-contact",
        data: {selected_contact:selected_contact},
        dataType: "JSON",
        success: function(data){
          if(data.result == true){
            $('#delete_contact_loading').hide();
            $('#contact_deleted').show();
            location.reload();
          }else{
            $('#delete_contact_loading').hide();
            $('#delete_contact_submit').show();
            alert(data.error_message);
          }
        }
      });
    });
  });
  </script>
<?php } ?>
</body>
</html>
