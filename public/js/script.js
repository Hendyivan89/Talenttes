$(function(){

    $('.btnTambahData').on('click', function(){
        var baseurl = $(this).data('zurl');
        $('#exampleModalLabel').html('Add Balance');
        $('.modal-footer button[type=submit]').html('Save');
        $('.modal-body form').attr('action', baseurl+'/balance/savebalance');
    });

    $('.btnWithdraw').on('click', function(){
        var baseurl = $(this).data('zurl');
        $('#exampleModalLabel').html('Withdraw Balance');
        $('.modal-footer button[type=submit]').html('Save');
        $('.modal-body form').attr('action', baseurl+'/balance/withdrawbalance');
    });

})