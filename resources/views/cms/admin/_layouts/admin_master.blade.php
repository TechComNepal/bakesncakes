<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>{{ $pageTitle }} | Bakes and Cakes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('cms/images/favicon.ico') }}">
    <!-- Summer Note -->
    <link href="{{ asset('cms/libs/summer-note/summernote-lite.min.css') }}" rel="stylesheet" />

    <!-- alertifyjs Css -->
    <link href="{{ asset('cms/libs/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- alertifyjs default themes  Css -->
    <link href="{{ asset('cms/libs/css/default.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('cms/libs/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- choices css -->
    <link href="{{ asset('cms/libs/css/choices.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('cms/libs/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cms/libs/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('cms/libs/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('cms/libs/css/fixedColumns.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- plugin css -->
    <link href="{{ asset('cms/libs/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ mix('cms/css/preloader.min.css') }}" type="text/css" />

    <!-- datepicker css -->
    <link href="{{ asset('cms/libs/css/flatpickr.min.css') }}" rel="stylesheet">

    <!-- Dropify -->
    <link href="{{ asset('cms/libs/css/dropify.min.css') }}" rel="stylesheet">

    <!-- Switchery -->
    <link rel="stylesheet" href="{{ asset('cms/libs/css/switchery.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ mix('cms/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ mix('cms/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('cms/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Select2 Css-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- bootstrap input tags css -->
    <link rel="stylesheet" href="{{ asset('cms/css/bootstrap-tagsinput.css') }}" />

    @stack('styles')
</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <x-cms-top-bar />
        <x-cms-side-bar />

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <p>Copyright ©
                                <script>
                                    document.write(new Date().getFullYear())

                                </script>
                                All Rights Reserved.
                                Designed by
                                <a href="https://www.stylustechnepal.com/" style="margin-left: 1px;color: goldenrod"
                                    target="_blank"> Stylus Technology</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>
    <x-cms-right-bar />

    <!-- JAVASCRIPT -->

    <script type="text/javascript" src="{{ asset('cms/libs/js/jquery.min.js') }}"></script>
    <!-- 1 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <script src="{{ asset('cms/libs/js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('cms/libs/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/waves.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('cms/libs/js/pace.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('cms/libs/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('cms/libs/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/jszip.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('cms/libs/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/fixedColumns.bootstrap4.min.js') }}">
    </script>


    <!-- Responsive examples -->
    <script src="{{ asset('cms/libs/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- choices js -->
    <script src="{{ asset('cms/libs/js/choices.min.js') }}"></script>

    <!-- color picker js -->
    <script src="{{ asset('cms/libs/js/@simonwep/pickr/pickr.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- datepicker js -->
    <script src="{{ asset('cms/libs/js/flatpickr.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('cms/libs/js/apexcharts.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('cms/libs/js/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script src="{{ asset('cms/libs/js/jquery-jvectormap-world-mill-en.js') }}">
    </script>


    <script src="{{ asset('cms/libs/js/form-editor.init.js') }}"></script>
    <!-- alertifyjs js -->
    <script src="{{ asset('cms/libs/js/alertify.min.js') }}"></script>

    <!-- Summer Note -->
    <script src="{{ asset('cms/libs/summer-note/summernote-lite.min.js') }}"></script>


    <!-- Sweet Alerts js -->
    <script src="{{ asset('cms/libs/js/sweetalert2.min.js') }}"></script>

    <!-- Dropify -->
    <script src="{{ asset('cms/libs/js/dropify.min.js') }}"></script>


    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('cms/libs/js/switchery.min.js') }}"></script>

    <!-- bootstrap tags input-->
    <script src="{{ asset('cms/js/bootstrap-tagsinput-1.min.js') }}"> </script>

    <!-- Typeahead Js-->
    <script src="{{ asset('cms/js/typeahead.bundle.js') }}"> </script>

    <!-- Ck Editor -->
    {{-- <script src="{{ asset('cms/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script> --}}

    <script src="{{ asset('cms/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ mix('cms/js/app.js') }}"></script>

    <script>
        //select2 box

        $('#myselect').select2({
            width: '100%',
            placeholder: "Select an Option",
            allowClear: true
        });

        $('body').on('click', '#mark-read', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var url = "{{ route('admin.newsletters.markRead') }}"

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    '_token': '{{ @csrf_token() }}'

                },
                success: function (data) {
                    $('#notify').load(location.href + (' #notify'));
                    $('#unread').html(
                        '<a href="#!" class="small text-reset text-decoration-underline"> Unread 0 </a>'
                    );
                    $('span#btn-count').html('0');

                }

            });

        });

        function markSingleRead(id) {
            var url = "{{ route('admin.notifications.markSingleRead', '') }}/" + id;
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    '_token': '{{ @csrf_token() }}'

                },
                success: function (data) {

                    $('#notify').load(location.href + (' #notify'));
                    $('#unread').html(
                        '<a href="#!" class="small text-reset text-decoration-underline"> Unread' + data
                        .count + '</a>'
                    );
                    $('span#btn-count').html(data.count);

                }

            });
        }

        $('body').on('click', '#delete-read', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var url = "{{ route('admin.newsletters.deleteAllRead') }}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    '_token': '{{ @csrf_token() }}'

                },
                success: function (data) {
                    $('#notify').load(location.href + (' #notify'));
                }

            });
        });

        function showConfirmationDialog(url, DTable) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3d4144',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'delete',
                        data: {
                            '_token': '{{ @csrf_token() }}'
                        },
                        success: function (result) {
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            ).then(() => {
                                DTable.ajax.reload();
                            })
                        },
                        error: function (result) {
                            console.log(result.success)
                            Swal.fire(
                                'Error!',
                                'Some Problem Occured. Please Try again later.',
                                'error'
                            ).then(() => {
                                location.reload();
                            })
                        }
                    })
                } else {
                    Swal.fire("Cancelled", "Deletion Cancelled", "error");
                }
            })
        }

        const initSwitchToggler = () => {
            if (document.querySelectorAll('.js-switch').length) {
                let switcheryEl = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                switcheryEl.forEach(function (html) {
                    new Switchery(html, {
                        size: 'small'
                    });
                });
            }
        }

    </script>

    <!-- Alertify -->
    @php
    $errors = Session::get('error');
    $messages = Session::get('success');
    $info = Session::get('info');
    $warnings = Session::get('warning');
    @endphp

    @if (is_array($errors))
    @foreach ($errors as $key => $value)
    <script>
        alertify.error("{{ $value }}")

    </script>
    @endforeach
    @endif

    @if ($messages)
    @foreach ($messages as $key => $value)
    <script>
        alertify.success("{{ $value }}")

    </script>
    @endforeach
    @endif

    @if ($info)
    @foreach ($info as $key => $value)
    <script>
        alertify.info("{{ $value }}")

    </script>
    @endforeach
    @endif

    @if ($warnings)
    @foreach ($warnings as $key => $value)
    <script>
        alertify.warning("{{ $value }}")

    </script>
    @endforeach
    @endif

    @stack('scripts')

</body>

</html>
