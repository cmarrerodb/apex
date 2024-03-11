<!-- JAVASCRIPT -->
<!-- <script src="/assets/js/jquery-3.5.1.js"></script> -->
<script src="{{ asset('/assets/js/jquery-3.5.1.js') }}"></script>

<!-- <script src="/assets/libs/bootstrap/bootstrap.min.js"></script> -->
<script src="{{ asset('/assets/libs/bootstrap/bootstrap.min.js') }}"></script>

<!-- <script src="/assets/libs/metismenu/metismenu.min.js"></script> -->
<script src="{{ asset('/assets/libs/metismenu/metismenu.min.js') }}"></script>

<!-- <script src="/assets/libs/simplebar/simplebar.min.js"></script> -->
<script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
<!-- <script src="/assets/libs/eva-icons/eva-icons.min.js"></script> -->
<script src="{{ asset('/assets/libs/eva-icons/eva-icons.min.js') }}"></script>
<!--TOASTR -->
<!-- <script src="/assets/libs/toastr/toastr.min.js"></script> -->
<script src="{{ asset('/assets/libs/toastr/toastr.min.js') }}"></script>
<!--SWEET ALERT 2 -->
<!-- <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script> -->
<script src="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!--BOOTSTRAP-TABLE -->
<!-- <script src="/assets/js/jspdf.min.js"></script> -->
<script src="{{ asset('/assets/js/jspdf.min.js') }}"></script>
<!-- <script src="/assets/js/jspdf.plugin.autotable.js"></script> -->
<script src="{{ asset('/assets/js/jspdf.plugin.autotable.js') }}"></script>
<!-- <script src="/assets/js/bootstrap-table.min.js"></script> -->
<script src="{{ asset('/assets/js/bootstrap-table.min.js') }}"></script>
<!-- <script src="/assets/js/bootstrap-table-locale-all.min.js"></script> -->
<script src="{{ asset('/assets/js/bootstrap-table-locale-all.min.js') }}"></script>
<!-- <script src="/assets/js/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script> -->
<script src="{{ asset('/assets/js/bootstrap-table/extensions/export/bootstrap-table-export.min.js') }}"></script>
<!-- <script src="/assets/js/bootstrap-table/extensions/export/tableExport.min.js"></script> -->
<script src="{{ asset('/assets/js/bootstrap-table/extensions/export/tableExport.min.js') }}"></script>
<!-- <script src="/assets/js/bootstrap-table/extensions/export/xlsx.full.min.js"></script> -->
<script src="{{ asset('/assets/js/bootstrap-table/extensions/export/xlsx.full.min.js') }}"></script>
<!-- <script src="/assets/js/bootstrap-table/extensions/export/Sheet.js"></script> -->
<!-- <script src="{{ asset('/assets/js/bootstrap-table/extensions/export/Sheet.js') }}"></script> -->
<!-- <script src="/assets/js/bootstrap-table/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js"></script> -->
<script src="{{ asset('/assets/js/bootstrap-table/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js') }}"></script>
<!-- <script src="/assets/js/jspdf.min.js"></script> -->
<script src="{{ asset('/assets/js/jspdf.min.js') }}"></script>
<!-- <script src="/assets/js/bootstrap-table-group-by.min.js"></script> -->
<script src="{{ asset('/assets/js/bootstrap-table-group-by.min.js') }}"></script>
<!-- <script src="/assets/js/jquery-ui-1.10.4.custom.min.js"></script> -->
<script src="{{ asset('/assets/js/jquery-ui-1.10.4.custom.min.js') }}"></script>
<!-- <script src="/assets/js/moment.min.js"></script> -->
<script src="{{ asset('/assets/js/moment.min.js') }}"></script>
<!-- JQUERY VALIDATOR -->
<!-- <script src="/assets/js/jquery-validate/jquery.validate.min.js"></script> -->
<script src="{{ asset('/assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
<!-- <script src="/assets/js/jquery-validate/additional-methods.min.js"></script> -->
<script src="{{ asset('/assets/js/jquery-validate/additional-methods.min.js') }}"></script>
<!-- <script src="/assets/js/jquery-validate/localization/messages_es.min.js"></script> -->
<script src="{{ asset('/assets/js/jquery-validate/localization/messages_es.min.js') }}"></script>
<!-- <script src="/assets/js/jquery-validate/localization/messages_es.min.js"></script> -->
<script src="{{ asset('/assets/js/jquery-validate/localization/messages_es.min.js') }}"></script>
<!-- JQUERY OVERLAY  -->
<!-- <script src="/assets/js/jquery-loading-overlay/loadingoverlay.min.js"></script> -->
<script src="{{ asset('/assets/js/jquery-loading-overlay/loadingoverlay.min.js') }}"></script>
<!-- SELECT2 -->
<!-- <script src="/assets/libs/select2/select2.min.js"></script> -->
<script src="{{ asset('/assets/libs/select2/select2.min.js') }}"></script>

<!-- Para la administracion -->
<script>
    var base_inicio = "{{ url('') }}";
</script>
<script src= "{{ url('') }}/assets/js/login-permiso-administracion.js"></script>

@yield('script')
@yield('script-bottom')
