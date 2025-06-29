const escpos = require('escpos');
escpos.USB = require('escpos-usb');

// Yazıcıyı bul (USB ile bağlı)
const device  = new escpos.USB();

// Yazıcıyı başlat
const printer = new escpos.Printer(device);

// Yazdırılacak adisyon verisi (örnek)
const printData = [
  'Masa: 5',
  'Siparişler:',
  '- Çay x2',
  '- Tost x1',
  'Toplam: 90 TL',
  'Teşekkürler!'
];

// Yazdırma fonksiyonu
device.open(function(error){
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