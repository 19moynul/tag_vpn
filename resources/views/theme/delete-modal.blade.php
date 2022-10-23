<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: none;border-radius: 20px;">
            <div class="mi-card mb-0">
                <div class="mi-header text-uppercase" id="title"></div>
                <div class="mi-body" id="body"></div>
                <div class="mi-footer " id="footer">
                    <div class="row float-right">
                        <div style="width:250px" class="m-auto">
                            <a onclick="return loader()" id="go-for-action"><button class="butn success m-auto" style="width:100px">YES</button></a>
                            <button class="butn secondary m-auto" data-dismiss="modal" style="width:100px" onclick="closeModal()">NO</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function ShowConfirmationMesage(data, event) {
        const anchor = event.target.closest("a");
        if (anchor) {
            var href = anchor.getAttribute('href');
            if (data) {
                $('#deleteModal .mi-header').removeClass(data.status);
                if (typeof data.status !== 'undefined') {
                    $('#deleteModal .mi-header').addClass(data.status);
                } else {
                    $('#deleteModal .mi-header').addClass('danger');
                }
                if (typeof data.title !== 'undefined') {
                    $('#title').html(data.title);
                }
                if (typeof data.body !== 'undefined') {
                    $('#body').html(data.body);
                }
                if (typeof data.footer !== 'undefined') {
                    $('#footer').html(data.footer);
                }

            } else {
                $('#title').html('Are you sure to perform this action ?');
            }

            $('#go-for-action').attr('href', href);

            $('#deleteModal').modal('toggle');
            return false;
        }
    }

    function closeModal() {
        $('#deleteModal').modal('hide');
    }
</script>
