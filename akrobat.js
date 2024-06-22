function validateForm() {
    const plat_kendaraan = document.getElementById("plat_kendaraan").value;
    const Nomor_mesin = document.getElementById("Nomor_mesin").value;
    const Nomor_rangka = document.getElementById("Nomor_rangka").value;

    if (!plat_kendaraan || !Nomor_mesin || !Nomor_rangka) {
      alert("Harap isi semua kolom dengan lengkap.");
      return false; // Jangan submit form jika ada yang kosong
    }

    // Jika semua kolom terisi, izinkan submit form
    return true;
  }