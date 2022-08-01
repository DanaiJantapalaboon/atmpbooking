<div class="modal fade" id="editBooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!--id เปลี่ยนให้ตรงกับ data-bs-toggle="#userModal" ในปุ่ม-->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Cleanroom Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body"> <!--เป็นฟอร์มใช้ insert ข้อมูล-->
                <img src="../img/calendar.webp" class="w-50 d-block mx-auto">
                <form action="../config/editbooking_db.php" method="POST">
                    <div class="mb-0">
                        <label for="name" class="col-form-label">Scheduler:</label>
                        <input type="text" value="<?php echo $booking['scheduler']; ?>" required class="form-control" name="scheduler">
                    </div>
                    <div class="mb-0">
                        <label for="purpose" class="col-form-label">Purpose:</label>
                        <input type="text" value="<?php echo $booking['purpose']; ?>" required class="form-control" name="purpose">
                    </div>
                    <div class="mb-0">
                        <label for="room" class="col-form-label">Room:</label>
                        <select class="form-select form-select-md" required onchange="document.getElementById('text_content').value=this.options[this.selectedIndex].text">
                            <option value="">Please select the rooms..</option>
                            <option value="1">Lab 307</option>
                            <option value="2">Lab 106</option>
                            <option value="3">Cleanroom 106</option>
                            <option value="4">Cleanroom 304</option>
                            <option value="5">Stem Cell Building</option>
                        </select>
                        <input type="hidden" name="room" id="text_content" value="" />
                    </div>
                    <div class="mb-0">
                        <label for="date" class="col-form-label">Start Date:</label>
                        <input type="date" required class="form-control" name="startdate">
                    </div>
                    <div class="mb-4">
                        <label for="date" class="col-form-label">Finished Date:</label>
                        <input type="date" required class="form-control" name="finisheddate">
                    </div>

                    <hr>
                    <div class="mb-3 mt-0">
                        <label for="name" class="col-form-label">Edit by:</label>
                        <input type="text" readonly value="<?php echo $booking['scheduler']; ?>" required class="form-control" name="editby">
                    </div>

                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="editbooking" class="btn btn-primary">Submit</button>
                    </div>
                        
                </form>
            </div>
        </div>
    </div>
</div>