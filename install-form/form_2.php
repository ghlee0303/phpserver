<div class="container-md install form_2" style="display:none">
    <?php if ($jud) echo "</form>"; ?>
    <form class="install_form" action="" method=" post" onsubmit="return false">
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-4">네트워크 설정</td>
                <td class="col-2">IP</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="network_ip" name="network[]" value="<?php echo $network_ip; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">SUBNET</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="network_subnet" name="network[]" value="<?php echo $network_subnet; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">GATEWAY</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="network_gateway" name="network[]" value="<?php echo $network_gateway; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">DNS</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="network_dns" name="network[]" value="<?php echo $network_dns; ?>">
                </td>
            </tr>
        </table>
        <div class="border-bottom-bl"></div>
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-4">서버설정</td>
                <td class="col-2">IP</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="server_ip" name="server[]" value="<?php echo $server_ip; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">PORT</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="server_port" name="server[]" value="<?php echo $server_port; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">ID</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="server_id" name="server[]" value="<?php echo $server_id; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">PASSWORD</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="server_pwd" name="server[]" value="<?php echo $server_pwd; ?>">
                </td>
            </tr>
        </table>
        <div class="border-bottom-bl"></div>
        <div class="fs-4 mt-4 text-center" style="position: absolute">
            경보방송<br>설정
        </div>
        <table class="table table-border install-table align-middle mt-4 fs-4">
            <tr>
                <td class="col-2"></td>
                <td class="col text-center border-bottom-gr" colspan="3">규모</td>
                <td class="col text-center p-0" style="border:2px">
                    &nbsp
                </td>
                <td class="col text-center border-bottom-gr" colspan="7">거리</td>
            </tr>
            <tr>
                <td class="col-2 ">1단계</td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="scale1-1" name="scale1[]" value="<?php echo $brod[0]['scale1']; ?>">
                </td>
                <td class="col text-center p-0">
                    &nbsp-&nbsp
                </td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="scale1-2" name="scale1[]" value="<?php echo $brod[0]['scale2']; ?>">
                </td>
                <td class="col text-center p-0">
                    &nbsp
                </td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="distance1" name="scale1[]" value="<?php echo $brod[0]['distance']; ?>">
                </td>
                <td class="col-1 text-center p-0">
                    km
                </td>
            </tr>
            <tr>
                <td class="col-2">2단계</td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="scale2-1" name="scale2[]" value="<?php echo $brod[1]['scale1']; ?>">
                </td>
                <td class="col text-center p-0">
                    &nbsp-&nbsp
                </td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="scale2-2" name="scale2[]" value="<?php echo $brod[1]['scale2']; ?>">
                </td>
                <td class=" col text-center p-0">
                    &nbsp
                </td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="distance2" name="scale2[]" value="<?php echo $brod[1]['distance']; ?>">
                </td>
                <td class="col text-center p-0">
                    km
                </td>
            </tr>
            <tr>
                <td class="col-2">3단계</td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="scale3-1" name="scale3[]" value="<?php echo $brod[2]['scale1']; ?>">
                </td>
                <td class="col text-center p-0">
                    &nbsp-&nbsp
                </td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="scale3-2" name="scale3[]" value="<?php echo $brod[2]['scale2']; ?>">
                </td>
                <td class="col text-center p-0">
                    &nbsp
                </td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="distance3" name="scale3[]" value="<?php echo $brod[2]['distance']; ?>">
                </td>
                <td class="col text-center p-0">
                    km
                </td>
            </tr>
            <tr>
                <td class="col-2">4단계</td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="scale4-1" name="scale4[]" value="<?php echo $brod[3]['scale1']; ?>">
                </td>
                <td class="col text-center p-0">
                    &nbsp-&nbsp
                </td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="scale4-2" name="scale4[]" value="<?php echo $brod[3]['scale2']; ?>">
                </td>
                <td class="col text-center p-0">
                    &nbsp
                </td>
                <td class="col text-center p-0">
                    <input type="text" class="col form-control fs-4 h-info_form border-bl text-center" id="distance4" name="scale4[]" value="<?php echo $brod[3]['distance']; ?>">
                </td>
                <td class="col align-center p-0">
                    km
                </td>
            </tr>
        </table>
        <div class="border-bottom-bl"></div>
        <table class="table install-table table-border fs-4 align-middle">
            <tr>
                <td class="col-4">설치 정보 입력</td>
                <td class="col-2">위도</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="latitude" name="latitude" value="<?php echo $lat; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1">경도</td>
                <td class="col-6 text-center p-0 ">
                    <input type="text" class="form-control fs-4 h-info_form border-bl text-center" id="longitude" name="longitude" value="<?php echo $lon; ?>">
                </td>
            </tr>
        </table>
        <div class="text-end mt-3">
            <button type="button" class="btn btn-outline-primary btn-mobile col-4" onclick="form_submit(0, 1)">임시저장</button>
        </div>
    </form>
</div>