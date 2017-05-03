<div class="row">
                <div class="{column}">

                    <div class="profile-image">
                        <img alt="profile" class="img-circle circle-border m-b-md" src="{avatar}" >
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    {name}
                                </h2>
                                <h4>{job} <i class="fa fa-circle text-navy" style="font-size: 10px;"></i> </h4>
                                <div class="contact-box-footer text-muted" style="font-size: 11px;">
                                    <div class="m-t-xs btn-group">
                                        <a class="btn btn-xs btn-white"><i class="fa fa-user"></i> {username}</a>
                                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> {email}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <tbody>
                        <tr>
                            <td>
                                <strong>Sitios Nuevos</strong> {sites}
                            </td>
                            <td>
                                <strong>Ingresos</strong> {revenue} 
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>Impresiones</strong> {impressions} 
                            </td>
                            <td>
                                <strong>Clicks</strong> {clicks}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <small>Ingresos este mes</small>
                    <h2 class="no-margins">{revenue}</h2>
                    <div id="revenue-sparkline"></div>
                </div>
            </div>
            <script>
                
        $(document).ready(function() {

            $("#revenue-sparkline").sparkline(<?=json_encode($chart) ?>, {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#1ab394',
                fillColor: "transparent"
            });

        });
    
            </script>

            <style type="text/css">
            .skin-1 img.circle-border {
                border: 6px solid #FFFFFF;
                border-radius: 50%;
            }

            .project-completion {
                padding-bottom: 20px;
            }
            </style>