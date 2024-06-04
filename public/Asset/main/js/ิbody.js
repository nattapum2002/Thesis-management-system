// เลือก element ของช่องรับเหตุผล
const reasonField = document.getElementById("reason-field");

// เลือก radio buttons สำหรับการอนุมัติและไม่อนุมัติเอกสาร
const approveRadio = document.getElementById("approve");
const rejectRadio = document.getElementById("reject");

// เมื่อมีการเปลี่ยนแปลงในการเลือก radio buttons
approveRadio.addEventListener("change", function () {
    // ถ้าเลือก "อนุมัติเอกสาร"
    if (this.checked) {
        // ซ่อนช่องรับเหตุผล
        reasonField.style.display = "none";
    }
});

rejectRadio.addEventListener("change", function () {
    // ถ้าเลือก "ไม่อนุมัติเอกสาร"
    if (this.checked) {
        // แสดงช่องรับเหตุผล
        reasonField.style.display = "block";
    }
});

// เรียกใช้งานเงื่อนไขเมื่อหน้าเว็บโหลดเสร็จ
window.addEventListener("load", function () {
    // ถ้าไม่มี radio button ใดถูกเลือกในตอนเริ่มต้น
    if (!approveRadio.checked && !rejectRadio.checked) {
        // ซ่อนช่องรับเหตุผล
        reasonField.style.display = "none";
    }
});
