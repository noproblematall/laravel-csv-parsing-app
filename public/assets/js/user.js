$(document).ready(function() {

    var _base_url = $("input[name=_base_url]").val();
    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function(){
        readURL(this);
    });

    var table1 = $('#in-process-table').DataTable({
        'ajax': _base_url+'/user/processing_list',
        'columnDefs': [
            {
                'targets': 0,
                'render': function(data, type, row, meta){
                if(type === 'display'){
                    data = '<div class=""><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                }

                return data;
                },
                'checkboxes': {
                'selectRow': true,
                'selectAllRender': '<div class=""><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                }
            }
        ],
        'select': 'multi',
        'order': [[5, 'desc']]
    });

    var table2 = $('#completed-list-table').DataTable({
        'ajax': _base_url+'/user/completed_list',
        'columnDefs': [
            {
                'targets': 0,
                'render': function(data, type, row, meta){
                if(type === 'display'){
                    data = '<div class=""><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                }

                return data;
                },
                'checkboxes': {
                'selectRow': true,
                'selectAllRender': '<div class=""><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                }
            }
        ],
        'select': 'multi',
        'order': [[4, 'desc']]
    });

})