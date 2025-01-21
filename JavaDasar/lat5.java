import java.util.Scanner;

public class lat5 {
    public static void main(String[] args) {
        System.out.println("Pemrograman InputOutput");
        Scanner InputUser = new Scanner(System.in);
        System.out.print("Masukkan Nilai Anda :");
        int angka = InputUser.nextInt();
        System.out.println("Nilai yang Anda Inputkan adalah : " + angka);

        Scanner InputUser1 = new Scanner(System.in);
        System.out.print("Masukkan Nama Anda :");
        String nama = InputUser1.nextLine();
        System.out.println("Nama Anda adalah : " + nama);
    } 
}
