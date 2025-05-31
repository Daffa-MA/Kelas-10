import java.util.Scanner;

public class rpl {
    public static void main(String[] args) {
        Raport siswa1 = new Raport();
        Scanner inputUser = new Scanner(System.in);
        
        System.out.println("Masukan nilai tugas : ");
        siswa1.tugas = inputUser.nextInt();
        System.out.println("Masukan nilai UTS : ");
        siswa1.uts = inputUser.nextInt();
        System.out.println("Masukan nilai UAS : ");
        siswa1.uas = inputUser.nextInt();

        System.out.println();

        System.out.println("Nilai tugas : " + siswa1.tugas);
        System.out.println("Nilai UTS : " + siswa1.uts);
        System.out.println("Nilai UAS : " + siswa1.uas);
        System.out.println("Rata-rata : " + (siswa1.tugas + siswa1.uts + siswa1.uas) / 3);
    }
}