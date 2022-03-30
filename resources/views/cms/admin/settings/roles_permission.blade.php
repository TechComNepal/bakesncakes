<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="''" />

    <x-error />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                        <h4 class="card-title">{{ $pageTitle }}</h4>
                        <p class="card-title-desc">{{ $subTitle }}</p>
                        <div class="ms-auto" style="float: right;">
                            <a href="{{ route('admin.setting.manage.roles.permission.index') }}" id="addRole"
                               class="btn btn-primary btn-md">
                                <i class='bx bx-cog'></i> Manage Role
                            </a>

                        </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach($roles as $role)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading-{{$role->name}}">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse-{{$role->id}}" aria-expanded="true" aria-controls="flush-collapse-{{$role->id}}">
                                    {{ ucwords($role->name) }}
                                </button>
                            </h2>
                            <div id="flush-collapse-{{$role->id}}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="flush-heading-{{$role->name}}"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <div class="form-group">
                                                            <div class="checkbox checkbox-info  col-md-10">
                                                                <input id="select_all_permission_{{ $role->id }}"
                                                                       @if(count($role->permissions) == $totalPermission) checked  @endif
                                                                       class="select_all_permission" value="{{ $role->id }}"
                                                                       type="checkbox">
                                                                <label for="select_all_permission_{{ $role->id }}">Select All</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th>Add</th>
                                                    <th>View</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($modulesData as $moduleData)
                                                <tr>
                                                    <th>{{ ucfirst($moduleData->module_name) }}</th>
                                                    @foreach($moduleData->permissions as $permission)
                                                    <td>
                                                        <input type="checkbox"
                                                               @if($role->hasPermissionTo($permission->name))
                                                                   checked
                                                               @endif
                                                               class="assign-role-permission permission_{{ $role->id }}"
                                                               data-permission-id="{{ $permission->id }}"
                                                               data-permission-name="{{ $permission->name }}"
                                                               data-role-id="{{ $role->id }}"/>
                                                    </td>
                                                    @endforeach
                                                    @if(count($moduleData->permissions) < 4)
                                                        @for($i=1; $i<=(4-count($moduleData->permissions)); $i++)
                                                            <td>&nbsp;</td>
                                                        @endfor
                                                    @endif
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- end accordion -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->

    </div> <!-- end row -->


    <!-- Manage Role Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>I will not close if you click outside me. Don't even try to press escape key.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script>
            $(function(){
                $('.assign-role-permission').on('change', assignRollPermission);
            });

            var assignRollPermission = function(){
                var roleId = $(this).data('role-id');
                var permissionId = $(this).data('permission-id');

                if ($(this).is(':checked'))
                    var assignPermission = 'yes';
                else
                    var assignPermission = 'no';

                var url = '{{route('admin.setting.roles.permission.store')}}';

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'roleId': roleId,
                        'permissionId': permissionId,
                        'assignPermission': assignPermission,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        alertify.success(data.msg)
                        location.reload();
                    }
                });

            }

            $('.assign-role-permission').change(assignRollPermission());

            $('.select_all_permission').change(function(){
                if($(this).is(':checked')){
                    var roleId = $(this).val();

                    var url = '{{ route('admin.setting.roles.permission.assign.all.permission') }}';

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            'roleId': roleId,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            alertify.success(data.msg)
                            location.reload();
                        }
                    });
                }
            })


            $('#addRole').click(function () {
                $('#staticBackdrop').modal('show');

            })

        </script>
    @endpush

</x-cms-master-layout>

