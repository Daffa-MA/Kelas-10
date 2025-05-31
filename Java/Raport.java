import java.util.Scanner;

public class Raport {
    private int tugas;
    private int uts;
    private int uas;

    public void inputNilai() {
        Scanner inputUser = new Scanner(System.in);
        
        System.out.println("Masukan nilai tugas : ");
        this.tugas = inputUser.nextInt();
        System.out.println("Masukan nilai UTS : ");
        this.uts = inputUser.nextInt();
        System.out.println("Masukan nilai UAS : ");
        this.uas = inputUser.nextInt();
    }

    public void tampilkanNilai() {
        System.out.println();
        System.out.println("Nilai tugas : " + this.tugas);
        System.out.println("Nilai UTS : " + this.uts);
        System.out.println("Nilai UAS : " + this.uas);
        double rataRata = (this.tugas + this.uts + this.uas) / 3.0;
        System.out.println("Rata-rata : " + rataRata);
    }

    public static void main(String[] args) {
        Raport siswa1 = new Raport();
        siswa1.inputNilai();
        siswa1.tampilkanNilai();
    }
}
