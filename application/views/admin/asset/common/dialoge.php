
        <div id="myModal" class="modal" style="display: none;">
            <!-- Modal content -->
            <div class="modal-content" id="dialogModal">
                <p style="margin-bottom:35px;text-align: center; font-size: 1.6rem; letter-spacing: 0.2px;">Are you sure you want to Logout?</p>
                <div class="btn-area">
                    <a href="<?php echo base_url(); ?>Admin/logout" class="btn-yes">OK</a>
                    <a class="btn-no" id="hideModal" onclick="d_none();">Cancel</a>
                </div>
            </div>
        </div>

            <script>
                function d_block() {
                     var block = document.getElementById('myModal');
                     block.style.display = 'block';
                }
                function d_none()
{
                     var block = document.getElementById('myModal');
                     block.style.display = 'none';
}
    </script>