<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token -->
    <title>@yield('title')</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/logo-icon.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/mm-vertical.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/semi-dark.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/bordered-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.js"></script>
    <!-- datables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    @yield('css')

    @stack('styles')
</head>

<body>
    @include('components.navbar')
    @include('components.sidebar')

    @yield('content')

    <!--bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard1.js') }}"></script>
    <script>
        new PerfectScrollbar(".user-list")
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('js')
    @if (session('success'))
        <script>
            $(document).ready(function() {
                Toastify({
                    text: '🎉 {{ session('success') }}',
                    duration: 5000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                        borderRadius: "10px",
                        boxShadow: "0px 4px 15px rgba(0, 0, 0, 0.1)",
                        padding: "10px 15px",
                    },
                    onClick: function() {}
                }).showToast();
            });
        </script>
    @endif

    @if (session('errors') && is_string(session('errors')))
        <script>
            $(document).ready(function() {
                Toastify({
                    text: '⚠️ {{ session('errors') }}',
                    duration: 5000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        borderRadius: "10px",
                        boxShadow: "0px 4px 15px rgba(0, 0, 0, 0.1)",
                        padding: "10px 15px",
                    },
                    onClick: function() {}
                }).showToast();
            });
        </script>
    @endif
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function renderUserDataTable(tableSelector = '#userTable', ajaxUrl = '', columns = []) {
            $(document).ready(function() {
                if (!ajaxUrl || columns.length === 0) {
                    console.warn("❌ renderUserDataTable: 'ajaxUrl' dan 'columns' harus diisi.");
                    return;
                }

                $(tableSelector).DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: ajaxUrl,
                    columns: columns
                });
            });
        }
    </script>

    <script>
        function submitFormAjax({
            formSelector = '#formUser',
            storeRoute = '',
            updateRouteTemplate = '',
            modalSelector = null,
            tableSelector = null,
            successMessage = 'Data berhasil disimpan',
            redirectUrl = null
        }) {
            $(formSelector).on('submit', function(e) {
                e.preventDefault();

                const submitBtn = $(formSelector).find('#submitBtn');
                const spinner = submitBtn.find('#spinner');
                const btnText = submitBtn.find('#submitBtnText');

                submitBtn.prop('disabled', true);
                spinner.removeClass('d-none');
                btnText.text('Menyimpan...');

                const id = $(`${formSelector} input[name="id"]`).val();
                const url = id ? updateRouteTemplate.replace('__ID__', id) : storeRoute;
                const method = 'POST';
                const formData = new FormData(this);

                if (id) {
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url,
                    type: method,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Toastify({
                            text: response.message || successMessage,
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            duration: 3000
                        }).showToast();

                        if (redirectUrl) {
                            setTimeout(() => {
                                window.location.href = redirectUrl;
                            }, 1000);
                            return;
                        }

                        if (modalSelector) {
                            $(modalSelector).modal('hide');
                        }

                        if (tableSelector) {
                            $(tableSelector).DataTable().ajax.reload();
                        }

                        $(formSelector)[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                Toastify({
                                    text: value[0],
                                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                                    duration: 4000
                                }).showToast();
                            });
                        } else if (xhr.status === 400 && xhr.responseJSON && xhr.responseJSON.message) {
                            Toastify({
                                text: xhr.responseJSON.message,
                                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                                duration: 4000
                            }).showToast();
                        } else {
                            Toastify({
                                text: "Terjadi kesalahan server. Silakan coba lagi.",
                                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                                duration: 4000
                            }).showToast();
                            console.error("AJAX ERROR:", xhr);
                        }

                        submitBtn.prop('disabled', false);
                        spinner.addClass('d-none');
                    },
                    complete: function() {
                        if (!redirectUrl) {
                            submitBtn.prop('disabled', false);
                            spinner.addClass('d-none');
                            btnText.text('Simpan');
                        }
                    }
                });
            });
        }

        function deleteResource(urlTemplate, id, name, tableSelector = '#userTable', title = 'Hapus Data?') {
            Swal.fire({
                title: title,
                text: `Apakah kamu yakin ingin menghapus "${name}"? Tindakan ini tidak bisa dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const deleteUrl = urlTemplate.replace('__ID__', id);

                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire('Berhasil!', response.message || 'Data berhasil dihapus.',
                                'success');
                            $(tableSelector).DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/utc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/timezone.js"></script>
    <script>
        dayjs.extend(dayjs_plugin_utc);
        dayjs.extend(dayjs_plugin_timezone);
    </script>
    @stack('scripts')
</body>

</html>
