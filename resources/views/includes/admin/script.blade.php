<!-- General JS Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.6/js/fileinput.min.js" integrity="sha512-IpeB734vID7QynL2cgdKMVDh1CNHndzxt9QKeq/aZQ5yItaDHcpWsg7C1tq4xCljTPa4l6EiJ1hUTaD/2KltiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/assets/js/stisla.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
 <!-- Data Tables -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
 <!-- DataTables  & Plugins -->
<script src="{{ url('public/datatables/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/datatables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('public/datatables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/datatables/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('public/datatables/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/datatables/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('public/datatables/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('public/datatables/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false,
      "lengthChange": true, 
      "autoWidth": true, 
      "paging": true, 
      "searching": true, 
      "ordering": true,
      "info": true,
    });
  });
</script>

<!-- JS Libraies -->
  <script src="{{ url('public/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ url('public/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ url('public/owl.carousel/dist/owl.carousel.min.js') }}"></script>
  <script src="{{ url('public/summernote/dist/summernote-bs4.js') }}"></script>
  <script src="{{ url('public/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ url('public/assets/js/scripts.js') }}"></script>
  <script src="{{ url('public/assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ url('public/assets/js/page/index.js') }}"></script>
  <script>
   ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        {
            toolbar : 'Full',
            enterMode : CKEDITOR.ENTER_BR,
            shiftEnterMode : CKEDITOR.ENTER_P
        }
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>