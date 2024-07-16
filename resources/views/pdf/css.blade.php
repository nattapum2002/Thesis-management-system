<style>
    @page {
        size: A4;
        margin-top: 20mm;
        margin-bottom: 20mm;
        margin-left: 25mm;
        margin-right: 25mm;
    }

    body {
        font-family: 'THSarabunNew', sans-serif;
        font-size: 16pt;
        line-height: 0.9;
        position: relative;
    }

    header {
        text-align: center;
        margin-bottom: -1pc;
    }

    header .documentId {
        text-align: right;
    }

    header .documentLogo {
        width: 55px;
    }

    header .documentHead {
        font-family: 'THSarabunNew', sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-style: none;
    }

    td {
        vertical-align: top;
        padding: 2px 0px;
        /* border-style: solid; */
    }

    table.solid {
        width: 100%;
        border-collapse: collapse;
        border-style: solid;
        border-width: 0.25pt;
    }

    table.solid td {
        vertical-align: top;
        padding: 0px 10px 5px 10px;
        border-style: solid;
        border-width: 0.25pt;
        text-align: center;
        vertical-align: middle;
    }

    .dotted {
        border-bottom: 1.5px dotted black;
    }

    .section {
        margin-top: 1pc;
    }

    .signature {
        text-align: center;
        padding: 5px 0px;
    }

    input[type="checkbox"] {
        border-style: none;
        vertical-align: -8px;
    }

    .footer {
        position: absolute;
        bottom: 0mm;
        /* ความสูงจากขอบล่างของกระดาษ */
        page-break-inside: avoid;
        /* ป้องกันการแบ่งฟุตเตอร์ในหน้าต่างๆ */
    }
</style>