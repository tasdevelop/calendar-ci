<html>
    <head>
    <title>Calendar</title>
        <meta charset='utf-8' />
        <link href="<?php echo base_url();?>libraries/css/bootstrap.min.css" rel="stylesheet">
        <link href='<?php echo base_url();?>libraries/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
        <link href="<?php echo base_url();?>libraries/css/bootstrapValidator.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>libraries/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>libraries/css/bootstrap-datetimepicker.css" rel="stylesheet" />

        <!-- Custom css  -->
        <link href="<?php echo base_url();?>libraries/css/custom.css" rel="stylesheet" />

        <script src='<?php echo base_url();?>libraries/js/moment.min.js'></script>
        <script src="<?php echo base_url();?>libraries/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>libraries/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>libraries/js/bootstrapValidator.min.js"></script>
        <script src="<?php echo base_url();?>libraries/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src='<?php echo base_url();?>libraries/js/bootstrap-colorpicker.min.js'></script>
        <script src='<?php echo base_url();?>libraries/js/bootstrap-datetimepicker.js'></script>
        <script src='<?php echo base_url();?>libraries/js/main_c.js'></script>
    <style>

    </style>
    </head>
    <body>
<div class="">
        <!-- Notification -->
        <div class="alert"></div>
        <div class="row clearfix">
             <p class="col-md-12">
                 <a href="<?php echo base_url();?>home" class="btn btn-default" >Kembali Ke Menu</a>
            </p>
            <div id='calendar'></div>
        </div>
        <br>
</div>
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="error"></div>
                    <form class="form-horizontal" id="crud-form">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="title">Title</label>
                            <div class="col-md-4">
                                <input id="title" name="title" type="text" class="form-control input-md" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="description">Description</label>
                            <div class="col-md-4">
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="color">Color</label>
                            <div class="col-md-4">
                                <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" />
                                <span class="help-block">Click to pick a color</span>
                            </div>
                        </div>
                        <input type="hidden" id="start">
                        <input type="hidden" id="end">
                        <!-- <div class="form-group">
                             <label class="col-md-4 control-label" for="title">Start</label>
                            <div class='input-group date col-md-4' id='datetimepicker1'>
                                <input type='text' id="start" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                             <label class="col-md-4 control-label" for="title">End</label>
                            <div class='input-group date col-md-4' id='datetimepicker2'>
                                <input type='text' id="end" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(function () {
        // $('#datetimepicker1').datetimepicker({
        //     format:'YYYY-MM-DD HH:mm:ss'
        // });
        // $('#datetimepicker2').datetimepicker({
        //     format:'YYYY-MM-DD HH:mm:ss'
        // });
    });
</script>
    </body>
</html>