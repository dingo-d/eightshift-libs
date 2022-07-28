<?php

dataset('errorStringArguments', [
	123123,
	false,
	null,
	[true],
	[true, null],
	new class{}
]);

dataset('getAllAllowedBlocksListAllTypesArguments', [
	true,
	false,
	[[]],
	[['test']]
]);

dataset('correctArguments', [
	'simple',
	'string with spaces',
	'String With special characters +_^&%$#@!9',
	[['bar', 'foo']],
	[['key' => 'bar', 'other-key' => 'foo']],
	[['key' => 'key']]
]);

dataset('classesArray', [
	[['medium', 'large']],
	[['small']],
	[['key' => 'bold--all']],
]);

// Rest/Fields arguments
dataset('correctFieldNameArguments', [
	[['field_name' => 'SomeField', 'object_type' => 'post']],
	[['field_name' => 'some field', 'object_type' => 'post']],
	[['field_name' => 'some-field', 'object_type' => 'post']],
	[['field_name' => 'some_field', 'object_type' => 'post']],
	[['field_name' => 'Some Field', 'object_type' => 'page']],
	[['field_name' => 'Some Field', 'object_type' => 'custom-post-type']],
]);

dataset('errorFieldNameArguments', [
	[['field_name' => 'SomeField']],
	[['object_type' => 'post']],
]);

// Rest/Routes arguments
dataset('correctRouteArguments', [
	[['endpoint_slug' => 'some-test', 'method' => 'post']],
	[['endpoint_slug' => 'some-test', 'method' => 'get']],
	[['endpoint_slug' => 'some-test', 'method' => 'put']],
	[['endpoint_slug' => 'some-test', 'method' => 'patch']],
	[['endpoint_slug' => 'some-test', 'method' => 'delete']],
	[['endpoint_slug' => 'someTest', 'method' => 'post']],
	[['endpoint_slug' => 'some_test', 'method' => 'post']],
	[['endpoint_slug' => 'some_Test_1', 'method' => 'post']],
]);

dataset('errorRouteArguments', [
	[['endpoint_slug' => 'some-test']],
	[['method' => 'post']],
]);

dataset('invalidRouteArguments', [
	[['endpoint_slug' => 'some-test', 'method' => 'asdad']],
	[['endpoint_slug' => '', 'method' => 'post']],
]);

dataset('inputSlugs', [
	'someName',
	'some-Name',
	'some name',
	'longer slug goes here',
	'mixed_Case_goes here-as well',
	'UPPER-CASE',
]);

// Exceptions
dataset('exceptionArguments', [
	7,
	null,
	true
]);

dataset('postsDifferentLength', [
  [[// 1043 words, 3 blocks 7022 chars - 6 min read
    [[
      // Block 427 words, 2854 chars
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras viverra pulvinar enim, in mattis ante facilisis eu. Ut viverra, erat ut accumsan facilisis, sem risus elementum est, quis egestas tortor mauris nec sem. Pellentesque faucibus sapien quis erat iaculis, non scelerisque velit cursus. Nunc porttitor, neque non tristique scelerisque, leo odio luctus tellus, at dapibus massa magna vitae turpis. Nulla quis auctor justo, eget convallis metus. Donec eu ultricies urna. Nam vulputate nisi sapien, convallis efficitur diam eleifend sed. Nunc pellentesque lacus sit amet elit finibus maximus. Praesent varius ut nisi vitae consequat. Ut luctus efficitur blandit. Vestibulum nulla nisi, laoreet ac dapibus eu, ornare non sapien. Curabitur et ultricies nulla. Nullam sed condimentum risus. Nulla sit amet odio augue. Vivamus quis tellus risus. Nulla posuere enim ut nunc suscipit tempor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin laoreet lorem nec massa egestas bibendum. Nulla pharetra ut ligula ut efficitur. Proin quis massa in orci semper iaculis. Fusce ligula mauris, molestie sit amet dui non, aliquam consectetur quam. Donec ac rhoncus massa. Nullam at aliquam sem. Etiam sit amet scelerisque est, ac tincidunt tortor. Fusce quis erat vitae ante tristique facilisis et ut nunc. Aliquam mi metus, vehicula eget justo ac, sollicitudin tristique neque. Fusce euismod tristique iaculis. Phasellus malesuada erat nec ante dignissim, id iaculis lectus rutrum. Nunc vulputate pharetra ligula, sed fermentum nulla malesuada ut. Donec molestie varius erat id faucibus. Integer purus risus, scelerisque vitae justo et, egestas lacinia diam. In hac habitasse platea dictumst. Duis turpis purus, imperdiet id est eu, malesuada vehicula mauris. Sed metus odio, tempus ultrices finibus et, lobortis ac orci. Etiam sodales purus massa, id dignissim ante volutpat eu. Nam aliquam nulla arcu, non malesuada diam finibus at. Donec suscipit, felis eu lobortis lobortis, justo ex accumsan leo, et varius ex urna faucibus tellus. Vivamus pretium turpis a volutpat lacinia. Phasellus at turpis at ipsum varius eleifend. Vivamus maximus facilisis erat. Aliquam placerat, urna nec sollicitudin tempus, sapien magna gravida augue, in auctor nulla mi nec massa. Nam eu sollicitudin velit. Pellentesque in sem ac nisl elementum elementum hendrerit a tellus. Nam et massa convallis, gravida lorem nec, porttitor augue. Nam id sagittis odio. Sed id magna eu enim euismod congue id non augue. Ut dui tellus, iaculis non aliquet eu, auctor a massa. Cras volutpat eros eget ligula placerat vulputate. Proin pulvinar sollicitudin nisl, a imperdiet diam lobortis sagittis. Etiam ultricies tempor dui et convallis. Aliquam varius sem dui, vel euismod nulla viverra imperdiet. Sed eget mauris at metus consequat ullamcorper.',
      // Block 200 words, 1377 chars
      'Nunc lobortis turpis urna, ac consectetur metus eleifend id. Sed ac sapien ac dolor facilisis fringilla. Suspendisse dictum mollis tortor ac finibus. Curabitur dapibus dignissim est, vel vehicula turpis vulputate vel. Cras tristique quam lectus, id pretium odio consectetur et. Cras posuere purus sit amet sapien tincidunt, sit amet ultrices nunc auctor. Nunc porta orci nisl, eu mattis tellus accumsan vitae. Mauris id risus felis. Aliquam et enim ipsum. Phasellus vel viverra nisl, vel tempor quam. Quisque ultricies suscipit sapien sit amet pharetra. Sed in massa consectetur, ullamcorper est vel, maximus eros. Etiam sit amet imperdiet lacus. Maecenas finibus laoreet malesuada. Phasellus ipsum nisl, sollicitudin sed magna quis, blandit vehicula lacus. Nam viverra ac mauris consectetur maximus. Phasellus hendrerit venenatis risus, sit amet convallis orci. Pellentesque vitae varius turpis, consectetur semper quam. In rutrum lectus massa, sit amet ultrices diam gravida vel. Quisque venenatis, sem a faucibus tempus, est dolor fringilla eros, eget mollis nibh nunc vel turpis. Quisque malesuada blandit leo, vel pharetra nisi. Praesent ante ipsum, fermentum eu pulvinar nec, efficitur eget nulla. Suspendisse justo elit, rhoncus eget sollicitudin eu, lacinia vel lorem. Donec euismod ante urna, ac pretium erat imperdiet vel. Cras consectetur bibendum enim id imperdiet.',
      // Block 416 words, 2791 chars
      'Donec dolor magna, pellentesque sed augue eu, vehicula viverra purus. Phasellus eu maximus lectus, eget posuere eros. Vestibulum hendrerit euismod ornare. Nam vel cursus nulla. Aliquam faucibus pharetra enim, eget vulputate mi fermentum eget. Proin luctus orci a ex feugiat dapibus. Nam ut lobortis risus. Fusce ac iaculis ante, vitae pulvinar ex. Cras placerat felis ornare elit gravida suscipit. Aenean in vestibulum nulla. Praesent eu ex euismod, porta velit ac, aliquam dolor. Pellentesque in purus varius, semper nibh quis, auctor mi. Vivamus nec risus et orci rutrum maximus at eget nulla. Etiam molestie, arcu et porttitor posuere, urna orci ultrices libero, at tincidunt arcu odio eget sem. Phasellus sit amet pretium eros. Etiam quis libero a ex sollicitudin maximus. Duis non nulla ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur bibendum lacus quis purus dictum, imperdiet gravida dolor cursus. Suspendisse tempor neque et hendrerit vestibulum. Mauris risus odio, eleifend vitae imperdiet quis, dignissim in nisl. Proin ultricies eget nibh a tempor. Mauris vitae magna augue. Donec suscipit convallis ante, quis vehicula lorem mollis at. Etiam id augue sodales, pharetra lacus sit amet, venenatis justo. Mauris ornare semper nulla ut dictum. Vivamus fringilla justo sed semper viverra. Suspendisse dictum arcu ut dui faucibus condimentum. In at quam maximus, egestas urna et, eleifend diam. Aliquam pulvinar arcu ut semper rutrum. Praesent diam libero, placerat nec tristique ut, hendrerit sed nisi. In ac neque a felis commodo pellentesque. Nunc interdum nisl nec pharetra sollicitudin. Vivamus dictum, libero vitae mollis laoreet, diam metus euismod odio, nec imperdiet augue velit vitae leo. Aliquam risus leo, aliquet in nisi nec, vulputate congue ligula. Suspendisse pulvinar libero eu sodales aliquet. Nullam finibus porttitor consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus dapibus sem at elementum rutrum. Nam mattis eu est vel tincidunt. Donec hendrerit massa ligula, at tempor diam facilisis et. Mauris sed porttitor risus. Nunc id purus est. Donec posuere aliquet ex, non tincidunt erat varius ornare. Donec varius, justo quis volutpat varius, justo mauris rutrum eros, at commodo magna dui et neque. Vestibulum libero tellus, mattis vel tellus nec, lobortis vehicula lectus. Sed euismod ex eu feugiat scelerisque. Aliquam ac augue in dolor faucibus pretium in sodales urna. Mauris vitae euismod neque, et finibus tortor. Integer tristique pellentesque nunc a egestas. Aenean accumsan, nisl convallis convallis aliquet, velit elit vestibulum neque, ac ultrices lacus libero ac augue. Proin in vulputate justo, eget feugiat nibh. Nulla sit amet commodo dui.',
    ]],
  ]],
  [[ // 735 words, 2 blocks, 5008 chars - 4 min read
    [[
      'Nunc lobortis turpis urna, ac consectetur metus eleifend id. Sed ac sapien ac dolor facilisis fringilla. Suspendisse dictum mollis tortor ac finibus. Curabitur dapibus dignissim est, vel vehicula turpis vulputate vel. Cras tristique quam lectus, id pretium odio consectetur et. Cras posuere purus sit amet sapien tincidunt, sit amet ultrices nunc auctor. Nunc porta orci nisl, eu mattis tellus accumsan vitae. Mauris id risus felis. Aliquam et enim ipsum. Phasellus vel viverra nisl, vel tempor quam. Quisque ultricies suscipit sapien sit amet pharetra. Sed in massa consectetur, ullamcorper est vel, maximus eros. Etiam sit amet imperdiet lacus. Maecenas finibus laoreet malesuada. Phasellus ipsum nisl, sollicitudin sed magna quis, blandit vehicula lacus. Nam viverra ac mauris consectetur maximus. Phasellus hendrerit venenatis risus, sit amet convallis orci. Pellentesque vitae varius turpis, consectetur semper quam. In rutrum lectus massa, sit amet ultrices diam gravida vel. Quisque venenatis, sem a faucibus tempus, est dolor fringilla eros, eget mollis nibh nunc vel turpis. Quisque malesuada blandit leo, vel pharetra nisi. Praesent ante ipsum, fermentum eu pulvinar nec, efficitur eget nulla. Suspendisse justo elit, rhoncus eget sollicitudin eu, lacinia vel lorem. Donec euismod ante urna, ac pretium erat imperdiet vel. Cras consectetur bibendum enim id imperdiet.',
      // Block 535 words, 3631 chars
      'Duis dictum accumsan massa, at fermentum quam lacinia id. Morbi dapibus gravida felis nec eleifend. Pellentesque sit amet tellus molestie turpis cursus feugiat in nec eros. Vivamus ornare elementum metus eget sagittis. Mauris purus odio, cursus in tortor in, rhoncus vulputate augue. Mauris imperdiet nec mauris eu lobortis. Nulla aliquam ex id lorem vehicula, a congue risus luctus. Cras vestibulum elit et sapien commodo, eget ultrices ligula commodo. Curabitur tristique ac sapien nec luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla a elit rhoncus est laoreet fermentum vitae vel nisi. Duis mi lorem, bibendum sed nunc sed, tincidunt tristique sem. Nunc sagittis lobortis imperdiet. Nam aliquam magna quam, ut convallis lorem porta quis. Vestibulum at facilisis tellus. Aenean vulputate erat quis sapien rhoncus dictum sed eget odio. Vestibulum ullamcorper faucibus sem, a ornare lectus. Nulla volutpat sapien id dapibus scelerisque. Aenean vel enim urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam laoreet finibus quam, sed porttitor arcu porta in. Fusce tempor fringilla urna, vitae sagittis sapien convallis sed. Mauris tincidunt sollicitudin lectus, consectetur auctor libero egestas sed. In commodo leo id semper tempus. Etiam tempus nunc vitae velit varius mattis. Quisque pharetra leo a arcu vulputate, non sollicitudin elit vulputate. Pellentesque egestas ligula velit, id hendrerit eros interdum nec. Fusce eget aliquet ligula. Nam vel ipsum a mauris vehicula commodo ac eu sem. Curabitur enim metus, euismod nec justo sed, malesuada blandit ex. Fusce sit amet consequat ligula. Aliquam magna purus, consectetur non nibh eget, condimentum vehicula nisl. Curabitur malesuada sit amet lacus eu pellentesque. Maecenas lobortis velit eget nisi volutpat, vel ultricies purus efficitur. Donec mattis, eros a mattis pretium, metus turpis laoreet neque, at cursus ex nibh pretium velit. Donec sit amet fringilla lorem, quis fringilla mi. Integer maximus lacus non risus aliquam sollicitudin. Etiam a gravida augue. Phasellus tincidunt consectetur felis sed tincidunt. Morbi diam risus, elementum ut cursus non, porttitor eu ex. Fusce rhoncus risus id est tincidunt, et commodo quam finibus. Mauris ligula tellus, aliquam sed vulputate vel, commodo at sapien. Aenean tempus sodales interdum. Praesent eget justo at odio venenatis tristique. Donec ac cursus lorem. Donec fermentum sodales dui, non maximus tellus. Nam et nisl nec diam eleifend volutpat. Etiam ligula eros, elementum vel enim nec, varius faucibus tellus. Cras tempor turpis dui, at viverra nibh pellentesque eu. Fusce magna diam, pharetra eu pretium non, condimentum non risus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam tristique ultrices condimentum. Aliquam sed venenatis sem. Nulla euismod lobortis augue, nec dignissim mauris varius vel. Fusce in tincidunt mauris. Etiam feugiat lorem rutrum, auctor urna non, finibus mi. Sed malesuada malesuada metus et porta. Vivamus pulvinar non tortor non porttitor. Suspendisse potenti. Ut tincidunt lorem eget vulputate egestas. Sed maximus maximus nisi id accumsan. Donec et risus a metus ultricies ultricies id nec arcu. Nullam fermentum lorem quis odio posuere, vel finibus tortor interdum. Ut vehicula ante eget dolor malesuada, sed pulvinar leo porttitor. Vivamus et nulla non quam maximus rhoncus ut id sem. Aenean suscipit facilisis dapibus. Cras auctor enim eget augue elementum, et tristique lacus dapibus. Phasellus mollis iaculis purus quis semper.',
    ]],
  ]],
  [[ // 1686 words, 4 blocks, 11430 chars - 9 min read
    [[
      'Nunc lobortis turpis urna, ac consectetur metus eleifend id. Sed ac sapien ac dolor facilisis fringilla. Suspendisse dictum mollis tortor ac finibus. Curabitur dapibus dignissim est, vel vehicula turpis vulputate vel. Cras tristique quam lectus, id pretium odio consectetur et. Cras posuere purus sit amet sapien tincidunt, sit amet ultrices nunc auctor. Nunc porta orci nisl, eu mattis tellus accumsan vitae. Mauris id risus felis. Aliquam et enim ipsum. Phasellus vel viverra nisl, vel tempor quam. Quisque ultricies suscipit sapien sit amet pharetra. Sed in massa consectetur, ullamcorper est vel, maximus eros. Etiam sit amet imperdiet lacus. Maecenas finibus laoreet malesuada. Phasellus ipsum nisl, sollicitudin sed magna quis, blandit vehicula lacus. Nam viverra ac mauris consectetur maximus. Phasellus hendrerit venenatis risus, sit amet convallis orci. Pellentesque vitae varius turpis, consectetur semper quam. In rutrum lectus massa, sit amet ultrices diam gravida vel. Quisque venenatis, sem a faucibus tempus, est dolor fringilla eros, eget mollis nibh nunc vel turpis. Quisque malesuada blandit leo, vel pharetra nisi. Praesent ante ipsum, fermentum eu pulvinar nec, efficitur eget nulla. Suspendisse justo elit, rhoncus eget sollicitudin eu, lacinia vel lorem. Donec euismod ante urna, ac pretium erat imperdiet vel. Cras consectetur bibendum enim id imperdiet.',
      'Donec dolor magna, pellentesque sed augue eu, vehicula viverra purus. Phasellus eu maximus lectus, eget posuere eros. Vestibulum hendrerit euismod ornare. Nam vel cursus nulla. Aliquam faucibus pharetra enim, eget vulputate mi fermentum eget. Proin luctus orci a ex feugiat dapibus. Nam ut lobortis risus. Fusce ac iaculis ante, vitae pulvinar ex. Cras placerat felis ornare elit gravida suscipit. Aenean in vestibulum nulla. Praesent eu ex euismod, porta velit ac, aliquam dolor. Pellentesque in purus varius, semper nibh quis, auctor mi. Vivamus nec risus et orci rutrum maximus at eget nulla. Etiam molestie, arcu et porttitor posuere, urna orci ultrices libero, at tincidunt arcu odio eget sem. Phasellus sit amet pretium eros. Etiam quis libero a ex sollicitudin maximus. Duis non nulla ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur bibendum lacus quis purus dictum, imperdiet gravida dolor cursus. Suspendisse tempor neque et hendrerit vestibulum. Mauris risus odio, eleifend vitae imperdiet quis, dignissim in nisl. Proin ultricies eget nibh a tempor. Mauris vitae magna augue. Donec suscipit convallis ante, quis vehicula lorem mollis at. Etiam id augue sodales, pharetra lacus sit amet, venenatis justo. Mauris ornare semper nulla ut dictum. Vivamus fringilla justo sed semper viverra. Suspendisse dictum arcu ut dui faucibus condimentum. In at quam maximus, egestas urna et, eleifend diam. Aliquam pulvinar arcu ut semper rutrum. Praesent diam libero, placerat nec tristique ut, hendrerit sed nisi. In ac neque a felis commodo pellentesque. Nunc interdum nisl nec pharetra sollicitudin. Vivamus dictum, libero vitae mollis laoreet, diam metus euismod odio, nec imperdiet augue velit vitae leo. Aliquam risus leo, aliquet in nisi nec, vulputate congue ligula. Suspendisse pulvinar libero eu sodales aliquet. Nullam finibus porttitor consequat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus dapibus sem at elementum rutrum. Nam mattis eu est vel tincidunt. Donec hendrerit massa ligula, at tempor diam facilisis et. Mauris sed porttitor risus. Nunc id purus est. Donec posuere aliquet ex, non tincidunt erat varius ornare. Donec varius, justo quis volutpat varius, justo mauris rutrum eros, at commodo magna dui et neque. Vestibulum libero tellus, mattis vel tellus nec, lobortis vehicula lectus. Sed euismod ex eu feugiat scelerisque. Aliquam ac augue in dolor faucibus pretium in sodales urna. Mauris vitae euismod neque, et finibus tortor. Integer tristique pellentesque nunc a egestas. Aenean accumsan, nisl convallis convallis aliquet, velit elit vestibulum neque, ac ultrices lacus libero ac augue. Proin in vulputate justo, eget feugiat nibh. Nulla sit amet commodo dui.',
      'Duis dictum accumsan massa, at fermentum quam lacinia id. Morbi dapibus gravida felis nec eleifend. Pellentesque sit amet tellus molestie turpis cursus feugiat in nec eros. Vivamus ornare elementum metus eget sagittis. Mauris purus odio, cursus in tortor in, rhoncus vulputate augue. Mauris imperdiet nec mauris eu lobortis. Nulla aliquam ex id lorem vehicula, a congue risus luctus. Cras vestibulum elit et sapien commodo, eget ultrices ligula commodo. Curabitur tristique ac sapien nec luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla a elit rhoncus est laoreet fermentum vitae vel nisi. Duis mi lorem, bibendum sed nunc sed, tincidunt tristique sem. Nunc sagittis lobortis imperdiet. Nam aliquam magna quam, ut convallis lorem porta quis. Vestibulum at facilisis tellus. Aenean vulputate erat quis sapien rhoncus dictum sed eget odio. Vestibulum ullamcorper faucibus sem, a ornare lectus. Nulla volutpat sapien id dapibus scelerisque. Aenean vel enim urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam laoreet finibus quam, sed porttitor arcu porta in. Fusce tempor fringilla urna, vitae sagittis sapien convallis sed. Mauris tincidunt sollicitudin lectus, consectetur auctor libero egestas sed. In commodo leo id semper tempus. Etiam tempus nunc vitae velit varius mattis. Quisque pharetra leo a arcu vulputate, non sollicitudin elit vulputate. Pellentesque egestas ligula velit, id hendrerit eros interdum nec. Fusce eget aliquet ligula. Nam vel ipsum a mauris vehicula commodo ac eu sem. Curabitur enim metus, euismod nec justo sed, malesuada blandit ex. Fusce sit amet consequat ligula. Aliquam magna purus, consectetur non nibh eget, condimentum vehicula nisl. Curabitur malesuada sit amet lacus eu pellentesque. Maecenas lobortis velit eget nisi volutpat, vel ultricies purus efficitur. Donec mattis, eros a mattis pretium, metus turpis laoreet neque, at cursus ex nibh pretium velit. Donec sit amet fringilla lorem, quis fringilla mi. Integer maximus lacus non risus aliquam sollicitudin. Etiam a gravida augue. Phasellus tincidunt consectetur felis sed tincidunt. Morbi diam risus, elementum ut cursus non, porttitor eu ex. Fusce rhoncus risus id est tincidunt, et commodo quam finibus. Mauris ligula tellus, aliquam sed vulputate vel, commodo at sapien. Aenean tempus sodales interdum. Praesent eget justo at odio venenatis tristique. Donec ac cursus lorem. Donec fermentum sodales dui, non maximus tellus. Nam et nisl nec diam eleifend volutpat. Etiam ligula eros, elementum vel enim nec, varius faucibus tellus. Cras tempor turpis dui, at viverra nibh pellentesque eu. Fusce magna diam, pharetra eu pretium non, condimentum non risus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam tristique ultrices condimentum. Aliquam sed venenatis sem. Nulla euismod lobortis augue, nec dignissim mauris varius vel. Fusce in tincidunt mauris. Etiam feugiat lorem rutrum, auctor urna non, finibus mi. Sed malesuada malesuada metus et porta. Vivamus pulvinar non tortor non porttitor. Suspendisse potenti. Ut tincidunt lorem eget vulputate egestas. Sed maximus maximus nisi id accumsan. Donec et risus a metus ultricies ultricies id nec arcu. Nullam fermentum lorem quis odio posuere, vel finibus tortor interdum. Ut vehicula ante eget dolor malesuada, sed pulvinar leo porttitor. Vivamus et nulla non quam maximus rhoncus ut id sem. Aenean suscipit facilisis dapibus. Cras auctor enim eget augue elementum, et tristique lacus dapibus. Phasellus mollis iaculis purus quis semper.',
      'Duis dictum accumsan massa, at fermentum quam lacinia id. Morbi dapibus gravida felis nec eleifend. Pellentesque sit amet tellus molestie turpis cursus feugiat in nec eros. Vivamus ornare elementum metus eget sagittis. Mauris purus odio, cursus in tortor in, rhoncus vulputate augue. Mauris imperdiet nec mauris eu lobortis. Nulla aliquam ex id lorem vehicula, a congue risus luctus. Cras vestibulum elit et sapien commodo, eget ultrices ligula commodo. Curabitur tristique ac sapien nec luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla a elit rhoncus est laoreet fermentum vitae vel nisi. Duis mi lorem, bibendum sed nunc sed, tincidunt tristique sem. Nunc sagittis lobortis imperdiet. Nam aliquam magna quam, ut convallis lorem porta quis. Vestibulum at facilisis tellus. Aenean vulputate erat quis sapien rhoncus dictum sed eget odio. Vestibulum ullamcorper faucibus sem, a ornare lectus. Nulla volutpat sapien id dapibus scelerisque. Aenean vel enim urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam laoreet finibus quam, sed porttitor arcu porta in. Fusce tempor fringilla urna, vitae sagittis sapien convallis sed. Mauris tincidunt sollicitudin lectus, consectetur auctor libero egestas sed. In commodo leo id semper tempus. Etiam tempus nunc vitae velit varius mattis. Quisque pharetra leo a arcu vulputate, non sollicitudin elit vulputate. Pellentesque egestas ligula velit, id hendrerit eros interdum nec. Fusce eget aliquet ligula. Nam vel ipsum a mauris vehicula commodo ac eu sem. Curabitur enim metus, euismod nec justo sed, malesuada blandit ex. Fusce sit amet consequat ligula. Aliquam magna purus, consectetur non nibh eget, condimentum vehicula nisl. Curabitur malesuada sit amet lacus eu pellentesque. Maecenas lobortis velit eget nisi volutpat, vel ultricies purus efficitur. Donec mattis, eros a mattis pretium, metus turpis laoreet neque, at cursus ex nibh pretium velit. Donec sit amet fringilla lorem, quis fringilla mi. Integer maximus lacus non risus aliquam sollicitudin. Etiam a gravida augue. Phasellus tincidunt consectetur felis sed tincidunt. Morbi diam risus, elementum ut cursus non, porttitor eu ex. Fusce rhoncus risus id est tincidunt, et commodo quam finibus. Mauris ligula tellus, aliquam sed vulputate vel, commodo at sapien. Aenean tempus sodales interdum. Praesent eget justo at odio venenatis tristique. Donec ac cursus lorem. Donec fermentum sodales dui, non maximus tellus. Nam et nisl nec diam eleifend volutpat. Etiam ligula eros, elementum vel enim nec, varius faucibus tellus. Cras tempor turpis dui, at viverra nibh pellentesque eu. Fusce magna diam, pharetra eu pretium non, condimentum non risus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam tristique ultrices condimentum. Aliquam sed venenatis sem. Nulla euismod lobortis augue, nec dignissim mauris varius vel. Fusce in tincidunt mauris. Etiam feugiat lorem rutrum, auctor urna non, finibus mi. Sed malesuada malesuada metus et porta. Vivamus pulvinar non tortor non porttitor. Suspendisse potenti. Ut tincidunt lorem eget vulputate egestas. Sed maximus maximus nisi id accumsan. Donec et risus a metus ultricies ultricies id nec arcu. Nullam fermentum lorem quis odio posuere, vel finibus tortor interdum. Ut vehicula ante eget dolor malesuada, sed pulvinar leo porttitor. Vivamus et nulla non quam maximus rhoncus ut id sem. Aenean suscipit facilisis dapibus. Cras auctor enim eget augue elementum, et tristique lacus dapibus. Phasellus mollis iaculis purus quis semper.',
    ]]
  ]],
  [[ // 427 words, 1 block, 2854 chars - 3 min read
    [[
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras viverra pulvinar enim, in mattis ante facilisis eu. Ut viverra, erat ut accumsan facilisis, sem risus elementum est, quis egestas tortor mauris nec sem. Pellentesque faucibus sapien quis erat iaculis, non scelerisque velit cursus. Nunc porttitor, neque non tristique scelerisque, leo odio luctus tellus, at dapibus massa magna vitae turpis. Nulla quis auctor justo, eget convallis metus. Donec eu ultricies urna. Nam vulputate nisi sapien, convallis efficitur diam eleifend sed. Nunc pellentesque lacus sit amet elit finibus maximus. Praesent varius ut nisi vitae consequat. Ut luctus efficitur blandit. Vestibulum nulla nisi, laoreet ac dapibus eu, ornare non sapien. Curabitur et ultricies nulla. Nullam sed condimentum risus. Nulla sit amet odio augue. Vivamus quis tellus risus. Nulla posuere enim ut nunc suscipit tempor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin laoreet lorem nec massa egestas bibendum. Nulla pharetra ut ligula ut efficitur. Proin quis massa in orci semper iaculis. Fusce ligula mauris, molestie sit amet dui non, aliquam consectetur quam. Donec ac rhoncus massa. Nullam at aliquam sem. Etiam sit amet scelerisque est, ac tincidunt tortor. Fusce quis erat vitae ante tristique facilisis et ut nunc. Aliquam mi metus, vehicula eget justo ac, sollicitudin tristique neque. Fusce euismod tristique iaculis. Phasellus malesuada erat nec ante dignissim, id iaculis lectus rutrum. Nunc vulputate pharetra ligula, sed fermentum nulla malesuada ut. Donec molestie varius erat id faucibus. Integer purus risus, scelerisque vitae justo et, egestas lacinia diam. In hac habitasse platea dictumst. Duis turpis purus, imperdiet id est eu, malesuada vehicula mauris. Sed metus odio, tempus ultrices finibus et, lobortis ac orci. Etiam sodales purus massa, id dignissim ante volutpat eu. Nam aliquam nulla arcu, non malesuada diam finibus at. Donec suscipit, felis eu lobortis lobortis, justo ex accumsan leo, et varius ex urna faucibus tellus. Vivamus pretium turpis a volutpat lacinia. Phasellus at turpis at ipsum varius eleifend. Vivamus maximus facilisis erat. Aliquam placerat, urna nec sollicitudin tempus, sapien magna gravida augue, in auctor nulla mi nec massa. Nam eu sollicitudin velit. Pellentesque in sem ac nisl elementum elementum hendrerit a tellus. Nam et massa convallis, gravida lorem nec, porttitor augue. Nam id sagittis odio. Sed id magna eu enim euismod congue id non augue. Ut dui tellus, iaculis non aliquet eu, auctor a massa. Cras volutpat eros eget ligula placerat vulputate. Proin pulvinar sollicitudin nisl, a imperdiet diam lobortis sagittis. Etiam ultricies tempor dui et convallis. Aliquam varius sem dui, vel euismod nulla viverra imperdiet. Sed eget mauris at metus consequat ullamcorper.',
    ]]
  ]]
]);

dataset('arrayIsListWrong', [[
	['a', 'b', 'c'],
	['1', '2', '3'],
	[],
	'',
	false,
	['1' => 'a', '0' => 'b', '2' => 'c'],
]]);

dataset('arrayIsListCorrect', [[
	['a' => 'a', 'b' => 'b', 'c' => 'c'],
	['a' => 'a', '1' => 'b', '2' => 'c'],
	['0' => 'a', '1' => 'b', '2' => 'c'],
]]);

dataset('camelToKebabCaseCheckCorrect', [
	['simpleTest', 'simple-test'],
	['easy', 'easy'],
	['HTML', 'html'],
	['simpleXML', 'simple-xml'],
	['PDFLoad', 'pdf-load'],
	['startMIDDLELast', 'start-middle-last'],
	['AString', 'a-string'],
	['Some4Numbers234', 'some4-numbers234'],
	['TEST123String', 'test123-string'],
	['hello_world', 'hello-world'],
	['hello__world', 'hello-world'],
	['_hello_world_', '-hello-world-'],
	['hello_World', 'hello-world'],
	['HelloWorld', 'hello-world'],
	['helloWorldFoo', 'hello-world-foo'],
	['hello-world', 'hello-world'],
	['myHTMLFiLe', 'my-html-fi-le'],
	['aBaBaB', 'a-ba-ba-b'],
	['BaBaBa', 'ba-ba-ba'],
	['libC', 'lib-c'],
	['Some Title', 'some-title'],
	['Some title', 'some-title'],
	['some title', 'some-title'],
	['some title longer', 'some-title-longer'],
]);

dataset('camelToKebabCaseCheckWrong', [
	['simpleTest', 'simpleTest'],
	['HTML', 'HTML'],
	['simpleXML', 'simpleXML'],
	['PDFLoad', 'PDFLoad'],
	['startMIDDLELast', 'startMIDDLELast'],
	['AString', 'AString'],
	['Some4Numbers234', 'Some4Numbers234'],
	['TEST123String', 'TEST123String'],
	['hello_world', 'hello_world'],
	['hello__world', 'hello__world'],
	['_hello_world_', '_hello_world_'],
	['hello_World', 'hello_World'],
	['HelloWorld', 'HelloWorld'],
	['helloWorldFoo', 'helloWorldFoo'],
	['myHTMLFiLe', 'myHTMLFiLe'],
	['aBaBaB', 'aBaBaB'],
	['BaBaBa', 'BaBaBa'],
	['libC', 'libC'],
]);

dataset('kebabToCamelCaseCheckCorrect', [
	['simple-test', 'simpleTest'],
	['easy', 'easy'],
	['simple-xml', 'simpleXml'],
	['pdf-load', 'pdfLoad'],
	['start-middle-last', 'startMiddleLast'],
	['a-string', 'aString'],
	['some4-numbers234', 'some4Numbers234'],
	['test123-string', 'test123String'],
	['test123 456', 'test123 456'],
	['hello-world', 'helloWorld'],
	['-hello-world-', 'helloWorld'],
	['hello-world', 'helloWorld'],
	['hello-world', 'helloWorld'],
	['hello-world-foo', 'helloWorldFoo'],
	['my-html-fi-le', 'myHtmlFiLe'],
	['a-ba-ba-b', 'aBaBaB'],
	['ba-ba-ba', 'baBaBa'],
	['lib-c', 'libC'],
]);

dataset('kebabToCamelCaseCheckWrong', [
	['simple-test', 'simpletest'],
	['HTML', 'HTML'],
	['simple-xml', 'simpleXML'],
	['pdf-load', 'PDFLoad'],
	['start-MIDDLE-last', 'startMIDDLElast'],
	['a-string', 'AString'],
	['some4-numbers234', 'Some4Numbers234'],
	['test123-string', 'Test123String'],
	['-hello-world-', 'HelloWorld'],
	['hello-world-foo', 'HelloWorldFoo'],
	['hello-world', 'HelloWorld'],
	['my-html-fi-le', 'MyHtmlFiLe'],
	['a-ba-ba-b', 'ABaBaB'],
	['ba-ba-ba', 'BaBaBa'],
	['lib-c', 'libc'],
]);

dataset('getGithubPluginNameCorrect', [
	['some-plugin-name', 'some-plugin-name'],
	['infinum/some-plugin-name', 'some-plugin-name'],
	['simple', 'simple'],
	['infinum/simple', 'simple'],
	['infinum/something-else/simple', 'simple'],
]);

dataset('getGithubPluginNameWrong', [
	['infinum/some-plugin-name', 'infinum/some-plugin-name'],
	['infinum/something-else/simple', 'infinum/something-else'],
	['infinum/something-else/simple', 'something-else/simple'],
]);

dataset('hexToRgbValid', [
	['#FFF', '255 255 255'],
	['#000000', '0 0 0'],
	['#123456', '18 52 86'],
]);

dataset('hexToRgbInvalid', [
	['', '0 0 0'],
	['#', '0 0 0'],
	['#1234', '0 0 0'],
	['#mnopqr', '0 0 0'],
	['#ESHIFT', '0 0 0'],
]);
