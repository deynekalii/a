const escpos = require('escpos');
escpos.USB = require('escpos-usb');

// Yazıcıyı bul (USB ile bağlı)
const device = new escpos.USB();

// Yazıcıyı başlat
const printer = new escpos.Printer(device);

// Adisyon verisi (örnek, açıklama dinamik eklenebilir)
const masa = '5';
const items = [
  { name: 'Çay', qty: 2 },
  { name: 'Tost', qty: 1 }
];
const toplam = '90 TL';
const note = 'Çorba açık olacak, hızlı servis'; // Açıklama burada (dinamik olabilir)

const printData = [
  `Masa: ${masa}`,
  'Siparişler:',
  ...items.map(item => `- ${item.name} x${item.qty}`),
];

// Açıklama varsa ekle
if (note && note.trim() !== '') {
  printData.push('---------------------');
  printData.push('AÇIKLAMA:');
  printData.push(note);
}

printData.push('---------------------');
printData.push(`Toplam: ${toplam}`);
printData.push('Teşekkürler!');

// Yazdırma fonksiyonu
device.open(function(error) {
  if (error) {
    console.log('Yazıcı bağlantı hatası:', error);
    return;
  }
  printer
    .align('CT')
    .style('B')
    .size(1, 1)
    .text('ADİSYON')
    .feed(1)
    .align('LT')
    .style('NORMAL')
    .size(0, 0);

  printData.forEach(line => printer.text(line));
  printer
    .feed(2)
    .cut()
    .close();
});