create table usuario (
    id int not null auto_increment,
    nome varchar(50) not null,
    email varchar(50) not null,
    senha varchar(50) not null,
    unique(id, email),
    primary key(id)
);

create table empresa (
    id int not null auto_increment,
    nome varchar(100) not null,
    cnpj varchar(20) not null,
    endereco varchar(255),
    unique(id, cnpj),
    primary key(id)
);

INSERT INTO empresa(nome, cnpj, endereco) VALUES
("JVR Construções", "47.444.567/0001-00", "Alameda Moinho Velho, 312"),
("JS Empreendimentos", "32.412.768/0001-39", "Avenida Ferdinando Augusto, 678");

create table funcao(
    id int not null auto_increment,
    descricao varchar(100) not null,
    unique(id, descricao),
    primary key(id)
);

INSERT INTO funcao(descricao) VALUES
("Pedreiro"),
("Pintor"),
("Eletricista"),
("Ajudante de Pedreiro"),
("Engenheiro"),
("Arquiteto"),
("Mestre de Obra"),
("Técnico de Segurança");


create table funcionario (
    id int not null auto_increment,
    nome varchar(100) not null,
    identificacao varchar(20),
    empresa int not null,
    funcao int not null,
    dataAdmissao date not null,
    unique(id, identificacao),
    primary key (id),
    foreign key (empresa) references empresa(id),
    foreign key (funcao) references funcao(id)
);

INSERT INTO funcionario(nome, identificacao, dataAdmissao, empresa, funcao) VALUES
("Pedreiro do Alê", "987.654.432-75", "2011-12-25", 2, 1),
("Helen Polido", "432.237.904-44", "2015-06-30", 1, 7),
("Henrique Couto", "123.456.789-99", "2010-08-20", 1, 1),
("Carlos dos Santos", "000.000.000-99", "2013-12-25", 2, 7);

create table tipotreinamento (
    id int not null auto_increment,
    descricao varchar(255) not null,
    primary key (id)
);

create table treinamento (
    id int not null auto_increment,
    empresa int not null,
    tipotreinamento int not null,
    data datetime not null,

    primary key (id),
    foreign key (empresa) references empresa(id),
    foreign key (tipotreinamento) references tipotreinamento(id)
);

CREATE TABLE funcionario_treinamento (
    funcionario INT(11) NOT NULL,
    treinamento INT(11) NOT NULL,

    PRIMARY KEY (funcionario, treinamento),
    FOREIGN KEY (funcionario) REFERENCES funcionario(id),
    FOREIGN KEY (treinamento) REFERENCES treinamento(id)
)



INSERT INTO usuario (nome,email,senha) VALUES ("Michael Fidelis", "mclexr@gmail.com", "testemaster"), ("Adriana Ferreira", "adrianadossantosferreira66@gmail.com", "testemaster#"), ("Carlos dos Santos", "csfidelis@gmail.com", "masterteste@@@");

INSERT INTO usuario (nome,email,senha) VALUES ('Coby','odio.semper@mus.com','ullamcorper, nisl');
INSERT INTO usuario (nome,email,senha) VALUES ('Serena','vitae@lobortistellus.com','quis lectus.');
INSERT INTO usuario (nome,email,senha) VALUES ('Erasmus','mus.Aenean@montes.ca','amet ante.');
INSERT INTO usuario (nome,email,senha) VALUES ('Morgan','mi@elementumlorem.com','elit, pretium');
INSERT INTO usuario (nome,email,senha) VALUES ('Alexander','Sed.congue@loremDonec.org','eu elit.');
INSERT INTO usuario (nome,email,senha) VALUES ('Tana','laoreet@nibhPhasellus.com','massa. Mauris');
INSERT INTO usuario (nome,email,senha) VALUES ('Mari','natoque.penatibus.et@lectus.net','fermentum risus,');
INSERT INTO usuario (nome,email,senha) VALUES ('Gay','felis.eget.varius@ametdiameu.co.uk','elit. Etiam');
INSERT INTO usuario (nome,email,senha) VALUES ('Flynn','eu@Aliquamauctor.net','odio semper');
INSERT INTO usuario (nome,email,senha) VALUES ('Destiny','porttitor.eros.nec@nequevenenatis.ca','ornare, libero');
INSERT INTO usuario (nome,email,senha) VALUES ('Blossom','neque@non.org','diam luctus');
INSERT INTO usuario (nome,email,senha) VALUES ('Avram','egestas.Aliquam.nec@duiFuscealiquam.org','penatibus et');
INSERT INTO usuario (nome,email,senha) VALUES ('Whoopi','eu@vulputatemauris.net','molestie tellus.');
INSERT INTO usuario (nome,email,senha) VALUES ('Todd','nulla.vulputate@felispurus.org','Donec elementum,');
INSERT INTO usuario (nome,email,senha) VALUES ('Cora','adipiscing.fringilla@aliquetPhasellus.edu','malesuada vel,');
INSERT INTO usuario (nome,email,senha) VALUES ('Kadeem','turpis@sedfacilisis.ca','in consequat');
INSERT INTO usuario (nome,email,senha) VALUES ('Timon','velit@Proin.ca','a, dui.');
INSERT INTO usuario (nome,email,senha) VALUES ('Malcolm','Cras@adipiscingelit.co.uk','interdum feugiat.');
INSERT INTO usuario (nome,email,senha) VALUES ('Igor','mattis@ac.co.uk','morbi tristique');
INSERT INTO usuario (nome,email,senha) VALUES ('Macey','Donec.at.arcu@metuseu.co.uk','feugiat nec,');
INSERT INTO usuario (nome,email,senha) VALUES ('Denise','vel.est@lectusrutrumurna.ca','aliquam eros');
INSERT INTO usuario (nome,email,senha) VALUES ('Abigail','Mauris@loremluctus.edu','ipsum dolor');
INSERT INTO usuario (nome,email,senha) VALUES ('May','turpis.egestas.Aliquam@etultrices.co.uk','risus. Donec');
INSERT INTO usuario (nome,email,senha) VALUES ('Illiana','felis.ullamcorper@nequeNullam.com','Duis sit');
INSERT INTO usuario (nome,email,senha) VALUES ('Garrison','sem.semper@aclibero.co.uk','mi lorem,');
INSERT INTO usuario (nome,email,senha) VALUES ('Paula','sit.amet.consectetuer@liberolacus.ca','dolor dapibus');
INSERT INTO usuario (nome,email,senha) VALUES ('Liberty','libero@odioAliquamvulputate.co.uk','Aliquam ultrices');
INSERT INTO usuario (nome,email,senha) VALUES ('Tatum','penatibus.et@pedeCum.ca','eu, placerat');
INSERT INTO usuario (nome,email,senha) VALUES ('Lance','a@quis.ca','et, lacinia');
INSERT INTO usuario (nome,email,senha) VALUES ('Elizabeth','dignissim.lacus@luctus.edu','est arcu');
INSERT INTO usuario (nome,email,senha) VALUES ('Brock','pellentesque.Sed@odiovelest.net','Proin nisl');
INSERT INTO usuario (nome,email,senha) VALUES ('Amaya','enim@neque.org','sem molestie');
INSERT INTO usuario (nome,email,senha) VALUES ('Xena','nulla.Donec@adipiscing.org','tellus eu');
INSERT INTO usuario (nome,email,senha) VALUES ('Adena','semper.cursus.Integer@Nulla.org','Nulla facilisi.');
INSERT INTO usuario (nome,email,senha) VALUES ('Bevis','Nunc@posuere.net','sit amet');
INSERT INTO usuario (nome,email,senha) VALUES ('Blossom','at@elitsed.org','hendrerit consectetuer,');
INSERT INTO usuario (nome,email,senha) VALUES ('Lenore','Duis.gravida@nasceturridiculus.org','blandit enim');
INSERT INTO usuario (nome,email,senha) VALUES ('Cooper','mauris@volutpatnunc.net','iaculis quis,');
INSERT INTO usuario (nome,email,senha) VALUES ('Candace','purus@NullafacilisiSed.ca','Duis at');
INSERT INTO usuario (nome,email,senha) VALUES ('Frances','sapien.cursus.in@Quisqueporttitor.com','enim non');
INSERT INTO usuario (nome,email,senha) VALUES ('Denton','Morbi.neque.tellus@maurissagittis.org','amet ante.');
INSERT INTO usuario (nome,email,senha) VALUES ('Hedwig','Ut.semper@montes.com','eu, odio.');
INSERT INTO usuario (nome,email,senha) VALUES ('Amethyst','facilisis.facilisis.magna@elit.org','Integer vitae');
INSERT INTO usuario (nome,email,senha) VALUES ('Charlotte','tempus.risus.Donec@in.ca','dui nec');
INSERT INTO usuario (nome,email,senha) VALUES ('Aaron','fringilla.est.Mauris@urnaconvallis.org','tempus eu,');
INSERT INTO usuario (nome,email,senha) VALUES ('Callie','sit@Curabituregestas.co.uk','Cum sociis');
INSERT INTO usuario (nome,email,senha) VALUES ('Illana','est@convallisest.co.uk','accumsan convallis,');
INSERT INTO usuario (nome,email,senha) VALUES ('Laith','libero@non.co.uk','Curae; Donec');
INSERT INTO usuario (nome,email,senha) VALUES ('Janna','urna.Nunc@viverraMaecenasiaculis.ca','ante ipsum');
INSERT INTO usuario (nome,email,senha) VALUES ('Katelyn','fermentum.arcu@accumsan.com','eu nulla');
INSERT INTO usuario (nome,email,senha) VALUES ('Lane','vel@blanditviverraDonec.ca','felis, adipiscing');
INSERT INTO usuario (nome,email,senha) VALUES ('Hiroko','magna@aliquamarcu.net','auctor, velit');
INSERT INTO usuario (nome,email,senha) VALUES ('Sloane','molestie@aliquetlobortisnisi.net','rutrum non,');
INSERT INTO usuario (nome,email,senha) VALUES ('Victor','sodales.Mauris@felis.net','massa rutrum');
INSERT INTO usuario (nome,email,senha) VALUES ('Inez','semper@ametconsectetueradipiscing.ca','porttitor vulputate,');
INSERT INTO usuario (nome,email,senha) VALUES ('Oleg','Maecenas.mi@ornaresagittisfelis.edu','In faucibus.');
INSERT INTO usuario (nome,email,senha) VALUES ('Jessamine','venenatis.vel@sem.co.uk','sapien. Nunc');
INSERT INTO usuario (nome,email,senha) VALUES ('Sean','Etiam.laoreet.libero@Nulla.ca','scelerisque neque');
INSERT INTO usuario (nome,email,senha) VALUES ('Kasper','dapibus.quam.quis@Nulla.net','mauris blandit');
INSERT INTO usuario (nome,email,senha) VALUES ('Bryar','ut.sem@volutpat.net','fermentum fermentum');
INSERT INTO usuario (nome,email,senha) VALUES ('Helen','vulputate@dictum.ca','posuere vulputate,');
INSERT INTO usuario (nome,email,senha) VALUES ('Kay','Nullam@variusNam.ca','dolor dapibus');
INSERT INTO usuario (nome,email,senha) VALUES ('Ocean','mus.Aenean.eget@dictumProin.ca','non, cursus');
INSERT INTO usuario (nome,email,senha) VALUES ('Valentine','semper.egestas@orciadipiscing.com','Aliquam fringilla');
INSERT INTO usuario (nome,email,senha) VALUES ('Orli','et.netus@Maurismolestie.co.uk','sollicitudin a,');
INSERT INTO usuario (nome,email,senha) VALUES ('Darryl','dictum.sapien@sedlibero.net','tincidunt orci');
INSERT INTO usuario (nome,email,senha) VALUES ('Lionel','Duis.at.lacus@sit.ca','ultrices iaculis');
INSERT INTO usuario (nome,email,senha) VALUES ('Angela','Sed.nunc@vitaevelitegestas.edu','nulla magna,');
INSERT INTO usuario (nome,email,senha) VALUES ('Tanek','Suspendisse.eleifend.Cras@placerat.edu','porttitor eros');
INSERT INTO usuario (nome,email,senha) VALUES ('Montana','et@ultricesposuere.net','magna. Nam');
INSERT INTO usuario (nome,email,senha) VALUES ('Shea','amet.nulla@dis.com','id risus');
INSERT INTO usuario (nome,email,senha) VALUES ('Neville','quis.turpis.vitae@arcu.ca','eget massa.');
INSERT INTO usuario (nome,email,senha) VALUES ('Jeremy','enim.diam@magnased.com','ipsum primis');
INSERT INTO usuario (nome,email,senha) VALUES ('Macy','Fusce.mi@non.com','dapibus rutrum,');
INSERT INTO usuario (nome,email,senha) VALUES ('Jescie','ipsum.Suspendisse.non@sodalespurus.net','auctor velit.');
INSERT INTO usuario (nome,email,senha) VALUES ('Christine','iaculis@euultrices.com','molestie orci');
INSERT INTO usuario (nome,email,senha) VALUES ('Macon','Suspendisse@velfaucibusid.org','magna et');
INSERT INTO usuario (nome,email,senha) VALUES ('Melvin','metus.vitae@augue.org','litora torquent');
INSERT INTO usuario (nome,email,senha) VALUES ('Moses','metus.vitae.velit@fringillaporttitorvulputate.net','lorem, luctus');
INSERT INTO usuario (nome,email,senha) VALUES ('Maxwell','posuere.vulputate@mollisnoncursus.org','orci tincidunt');
INSERT INTO usuario (nome,email,senha) VALUES ('Jeanette','Ut.nec.urna@variusorciin.edu','sem magna');
INSERT INTO usuario (nome,email,senha) VALUES ('Rachel','ornare.lectus.justo@porttitor.edu','ultrices iaculis');
INSERT INTO usuario (nome,email,senha) VALUES ('Stacey','vestibulum.nec.euismod@cubiliaCurae.ca','nec, mollis');
INSERT INTO usuario (nome,email,senha) VALUES ('Lance','vulputate@Maurisvestibulumneque.com','Cras eget');
INSERT INTO usuario (nome,email,senha) VALUES ('Kato','Vivamus.rhoncus.Donec@Nam.edu','amet metus.');
INSERT INTO usuario (nome,email,senha) VALUES ('Justin','risus.Donec@estmollis.com','nulla vulputate');
INSERT INTO usuario (nome,email,senha) VALUES ('Maryam','dis.parturient@Integer.net','Etiam gravida');
INSERT INTO usuario (nome,email,senha) VALUES ('Ariana','dapibus@dolor.org','tellus id');
INSERT INTO usuario (nome,email,senha) VALUES ('Sierra','hendrerit@et.com','nulla. Integer');
INSERT INTO usuario (nome,email,senha) VALUES ('Lynn','sit@egetvariusultrices.co.uk','nec enim.');
INSERT INTO usuario (nome,email,senha) VALUES ('Jordan','lectus.quis@adipiscingelit.co.uk','diam. Proin');
INSERT INTO usuario (nome,email,senha) VALUES ('Leila','aliquam@libero.org','vel pede');
INSERT INTO usuario (nome,email,senha) VALUES ('Quinlan','Aliquam.erat.volutpat@dis.net','Proin dolor.');
INSERT INTO usuario (nome,email,senha) VALUES ('Cheryl','quis.urna@idmagnaet.com','gravida non,');
INSERT INTO usuario (nome,email,senha) VALUES ('Dominic','dui.lectus@aliquam.ca','dui, nec');
INSERT INTO usuario (nome,email,senha) VALUES ('Griffith','aliquet.molestie@lectusante.net','dui, in');
INSERT INTO usuario (nome,email,senha) VALUES ('Cole','Etiam.laoreet.libero@Quisquetinciduntpede.co.uk','imperdiet non,');
INSERT INTO usuario (nome,email,senha) VALUES ('Lionel','lectus@in.co.uk','arcu iaculis');
INSERT INTO usuario (nome,email,senha) VALUES ('Freya','lorem@euismodest.co.uk','orci quis');
INSERT INTO usuario (nome,email,senha) VALUES ('Zeus','Maecenas.iaculis@luctus.ca','Cras convallis');
