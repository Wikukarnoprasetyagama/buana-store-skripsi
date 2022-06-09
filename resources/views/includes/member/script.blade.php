<!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ url('/assets/js/stisla.js') }}"></script>

  <!-- Data Tables -->
 <!-- DataTables  & Plugins -->
<script src="{{ url('/datatables/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('/datatables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/datatables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('/datatables/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('/datatables/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('/datatables/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('/datatables/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('/datatables/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
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
  <script src="{{ url('/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ url('/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ url('/owl.carousel/dist/owl.carousel.min.js') }}"></script>
  <script src="{{ url('/summernote/dist/summernote-bs4.js') }}"></script>
  <script src="{{ url('/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ url('/assets/js/scripts.js') }}"></script>
  <script src="{{ url('/assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ url('/assets/js/page/index.js') }}"></script>

  {{-- Ckeditor --}}
  <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>

<script>
   ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>
