<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="''" />

    <x-error />

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">List of Roles</h4>
                    </div>
                </div>
                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                        <tr>
                            <th>SN.</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <x-form-base :route="'admin.setting.create.roles'" :title="$pageTitle" :subTitle="$subTitle">

                <!-- Name -->
                <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter role name here.'" :required="true" :autofocus="true" />

                <x-button />

            </x-form-base>
        </div>
    </div>

    @push('scripts')
    <script>
        // Datatable
        $(document).ready(() => {

            var DTable = $("#datatable").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                processing: true,
                serverSide: true,
                responsive: false,
                ajax: window.location.href,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                "fnDrawCallback": function() {
                    initSwitchToggler();
                }
            });

            $('#datatable').on('click', '#delete-btn', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var id = $(this).data('id');
                var delete_url = "{{ route('admin.brands.destroy', '') }}/" + id;

                showConfirmationDialog(delete_url, DTable);
            });

        });
    </script>
    @endpush


</x-cms-master-layout>
