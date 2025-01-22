public class smkn2 {
    public static void main(String[] args) {
        xrpl object = new xrpl();
        System.out.println("nama saya : " + object.nama);
        System.out.println("alamat saya : "+ object.alamt);
        System.out.println("tahun lahir saya : " + object.tahunlahir);
        System.out.println("umur saya : " + object.umur);

  
        object.belajar();
        System.out.println("");
        double menghitungnilai=object.nilai ();
        System.out.println("nilai Rerata Kelas X RPL : "+ menghitungnilai);
    } 
}
