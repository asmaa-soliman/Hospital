
<!-- Modal  add department-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/sections_trans.add_sections')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('Sections.store') }}" method="post" autocomplete="off">
        @csrf
      <div class="modal-body">
                     <label for="exampleInputPassword1">{{trans('Dashboard/sections_trans.name_sections')}}</label>
                    <input type="text" name="name" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.close')}}</button>
        <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
      </div>
    </div>
  </div>
</div>









