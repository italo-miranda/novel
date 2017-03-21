-- Geração de Modelo físico

DROP DATABASE Novel;
CREATE DATABASE Novel;
ALTER DATABASE Novel CHARACTER SET utf8 COLLATE utf8_general_ci;
USE Novel;

CREATE TABLE Jogador (
email Varchar(30) NOT NULL,
senha Varchar(80) NOT NULL,
experiencia int DEFAULT 0,
tempoTotal int DEFAULT 0,
codJogador int PRIMARY KEY AUTO_INCREMENT,
nivel int DEFAULT 1,
login Varchar(20) NOT NULL,
avatar Varchar(20) NOT NULL,
nome Varchar(50) NOT NULL
);

ALTER TABLE Jogador CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Grafema (
tipoGrafema Varchar(30) NOT NULL,
codGrafema int PRIMARY KEY AUTO_INCREMENT,
quadros int NOT NULL
);

ALTER TABLE Grafema CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Teste (
enunciado Varchar (5000) NOT NULL,
codTeste int PRIMARY KEY AUTO_INCREMENT,
gabarito Char(80) NOT NULL,
codGrafema int NOT NULL,
FOREIGN KEY(codGrafema) REFERENCES Grafema (codGrafema)
);

ALTER TABLE Teste CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Alternativas (
codAlternativa int PRIMARY KEY AUTO_INCREMENT,
alternativa Varchar(200) NOT NULL,
codTeste int NOT NULL,
FOREIGN KEY(codTeste) REFERENCES Teste (codTeste)
);

ALTER TABLE Alternativas CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE GrupoTeste (
codGrupo int PRIMARY KEY AUTO_INCREMENT,
grafemas VarChar(30) NOT NULL
);

ALTER TABLE GrupoTeste CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Texto (
textoIncompleto Varchar(15000) NOT NULL,
imagem VarChar(50),
codTexto int PRIMARY KEY AUTO_INCREMENT
);

ALTER TABLE Texto CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Gabarito (
posicao int NOT NULL,
letraGabarito Char(2) NOT NULL,
codGabarito int PRIMARY KEY AUTO_INCREMENT, 
codTexto int NOT NULL,
FOREIGN KEY(codTexto) REFERENCES Texto (codTexto)
);

ALTER TABLE Gabarito CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE GrafemaTexto (
codTexto int NOT NULL,
codGrafema int NOT NULL,
FOREIGN KEY(codTexto) REFERENCES Texto (codTexto),
FOREIGN KEY(codGrafema) REFERENCES Grafema (codGrafema)
);

ALTER TABLE GrafemaTexto CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Palavra (
palavraIncompleta Varchar(25) NOT NULL,
letraGabarito Char(5) NOT NULL,
enunciado Varchar(600) NOT NULL,
justificativa VarChar(200) NOT NULL,
imagem VarChar(50),
palavraCompleta VarChar(25) NOT NULL,
codPalavra int PRIMARY KEY AUTO_INCREMENT,
codGrafema int NOT NULL,
FOREIGN KEY(codGrafema) REFERENCES Grafema (codGrafema)
);

ALTER TABLE Palavra CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Rodada (
pontuacao int NOT NULL,
duracao int NOT NULL,
tipoRodada Enum ('palavra','texto', 'teste') NOT NULL,
codRodada int PRIMARY KEY AUTO_INCREMENT,
codJogador int NOT NULL,
FOREIGN KEY(codJogador) REFERENCES Jogador (codJogador)
);

ALTER TABLE Rodada CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE RodadaGrafema (
codGrafema int NOT NULL,
codRodada int NOT NULL,
FOREIGN KEY(codGrafema) REFERENCES Grafema (codGrafema),
FOREIGN KEY(codRodada) REFERENCES Rodada (codRodada)
);

ALTER TABLE RodadaGrafema CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Conquista (
codConquista int PRIMARY KEY AUTO_INCREMENT,
nomeConquista Varchar(200) NOT NULL,
experienciaDesbloqueio int NOT NULL
);

ALTER TABLE Conquista CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE ConquistaJogador (
codJogador int NOT NULL,
codConquista int NOT NULL,
FOREIGN KEY(codJogador) REFERENCES Jogador (codJogador),
FOREIGN KEY(codConquista) REFERENCES conquista (codConquista)
);

ALTER TABLE ConquistaJogador CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Cenas (
codCena int PRIMARY KEY AUTO_INCREMENT,
nomeCena Varchar(20) NOT NULL,
quadros int NOT NULL,
nivelDesbloqueio int NOT NULL
);

ALTER TABLE Cenas CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Administrador (
login Varchar(20) NOT NULL,
senha Varchar(20) NOT NULL,
nome Varchar(50) NOT NULL,
email Varchar(30) NOT NULL,
codAdministrador int PRIMARY KEY AUTO_INCREMENT
);

ALTER TABLE Administrador CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE Bonus (
codBonus int PRIMARY KEY AUTO_INCREMENT,
experienciaNecessaria int NOT NULL,
textoBonus VarChar(225) NOT NULL
);

ALTER TABLE Bonus CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE PalavraBonus (
codPalavraBonus int PRIMARY KEY AUTO_INCREMENT,
palavra VarChar(20) NOT NULL,
inicio int NOT NULL,
fim int NOT NULL,
codBonus int NOT NULL,
FOREIGN KEY(codBonus) REFERENCES Bonus (codBonus)
);

ALTER TABLE PalavraBonus CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE JogadorBonus (
codBonus int,
codJogador int,
FOREIGN KEY(codBonus) REFERENCES Bonus (codBonus),
FOREIGN KEY(codJogador) REFERENCES Jogador (codJogador)
);

ALTER TABLE JogadorBonus CHARACTER SET utf8 COLLATE utf8_general_ci;

--Insercao de dados

--Insercao de dados

INSERT INTO Jogador (nome, email, login, senha, avatar) VALUES 
  ("Teste", "teste@mail.com", "teste", "teste", "graciliano");

INSERT INTO Grafema (tipoGrafema, quadros) VALUES 
	("g_j", 3),
  	("ch_x", 3),
	("s_z_x", 3),
	("c_ç_s_ss_sc_sç_xc", 3),
	("m_n", 1),
  	("r_rr", 2),
	("e_i", 3),
	("o_u_l", 2);

-- AQUI SO VAI O ENUNCIADO E O GABARITO
-- O GABARITO DEVE SER A IGUAL A ALTERNATIVA CORRETA E NAO
-- AS LETRAS QUE RESPONDEM A QUESTAO

INSERT INTO Teste (enunciado, gabarito, codGrafema) VALUES 
	("Assinale a série em que todas as palavras devam ser escritas com j.", "Laran_eiro, _egue, _ibóia", 1),
	("Assinale a série em que todas as palavras devam ser escritas com g.", "_eléia, massa_em, li_eiro",1),
	("Marque o item cujos vocábulos devem ser grafados com a letra indicada entre parênteses.", "Ferru_em, farin_e, o_iva (g)",1),
	("Em qual das opções g preenche todas as lacunas?", "Co_itar, al_ema",1),
	("Em qual das opções j preenche todas as lacunas?", "Lambu_em, _egue, tre_eito",1),
	("Assinale a opção que contém erro de ortografia.", "Mangedoura",1),
	("Assinale a opção em que a palavra está escrita corretamente.", "Jerimum",1),
	("Marque a alternativa que contém palavra grafada corretamente.", "Vagem",1),
	("Assinale a opção que contém palavra grafada corretamente."," Jirau",1),
	("Preencha os espaços com g ou j para que os vocábulos fiquem escritos 
	corretamente e marque a sequência correta: lo_inha, en_eitar, ti_ela", "J, j, g",1),
	("Marque a alternativa que contém palavra grafada corretamente.", "Refúgio",1),
	("Marque a alternativa que contém palavra grafada corretamente.", "Gíria",1),
	("Marque a alternativa que contém palavra grafada corretamente."," 	Gimnosperma",1),
	("Marque a alternativa que contém palavra grafada corretamente.", "Angioplastia",1),
	("Marque a alternativa que contém palavra grafada corretamente.", "Vertigem",1),
	("Assinale a alternativa em que todos os vocábulos estejam grafados corretamente:", "muxoxo, chispa, xangô", 2),
	("Dos grupos de palavras abaixo o único que não contém palavras escritas com ch é:", "froucho, cherife, chavante.", 2),
	("Somente uma alternativa contém palavras grafadas corretamente:", "abacaxi, chofer, piche.", 2),
	("São escritas com ch , x e ch respectivamente:", "preencher, atarraxar, chuviscando", 2),
	("Qual alternativa em que nenhuma das palavras é escrita com x?",  "baxaréu, enxente, moxila", 2), 
	("Somente uma alternativa está incorreta", "xamego,  brocha, laxante", 2),
	("A alternativa em que todas as palavras são grafadas com ch é:", "murchar, pechincha, mecha.", 2),
	("O índio_____ participou da______________ no ____________", "xavante, chacina, Xingu", 2),
	("O __________ do bebê está_________ de __________, que são pequenas pedras.", 	"chocalho, cheio, seixos", 2),
	("___________,_________________ e ______________ ajudam a curar resfriados.", "xarope, chá, cochilo.", 2),
	("Paguei uma ____________ alta pelo___________  que comprei na __________", "taxa, tacho, chapada", 2),
	("O___________ é um __________ que vive a ______________os imigrantes.", "xerife, xenófobo, xingar.", 2),
	("Minha mão está___________ porque acertei a_____________ nela.", "inchada, enxada.", 2),
	("O ________ do______________ teria ____________ o __________.", "chefe, almoxarifado, achincalhado, faxineiro.", 2),
	("Somente uma alternativa não contém palavras grafadas com X.", "xiste, linxar, xiado.", 2),
	("Assinale a série em que todas as palavras devam ser escritas com x.", "E_ótico, e_alar, ê_odo",3),
	("Assinale a série em que todas as palavras devam ser escritas com z.", "A_eite, a_ar, ami_ade",3),
	("Assinale a série em que todas as palavras devam ser escritas com s.", "Aga_alho, avi_o, deci_ão",3),
	("Marque o item cujos vocábulos devem ser grafados com a letra indicada entre parênteses.", "E_orbitante, e_emplo, e_istência (x)",3),
	("Em qual das opções x preenche todas as lacunas?", "E_ibir, e_ato, e_orcista",3),
	("Em qual das opções z preenche todas as lacunas?", "Aprendi_agem, Alfa_ema, timide_",3),
	("Em qual das opções s preenche todas as lacunas?", "Curio_idade, fa_e, me_ada",3),
	("Assinale a opção que contém erro de ortografia.", "luzo",3),
	("Assinale a opção que as palavras estão escritas corretamente.", "Surpresa, tesouro",3),
	("Marque a alternativa que contém palavra grafada incorretamente.", "esacerbar",3),
	("Assinale a opção que contém palavra grafada incorretamente.", "esasperação",3),
	("Preencha os espaços com x, z ou x para que os vocábulos fiquem escritos corretamente e marque a sequência correta: e_igência, Ama_onense, pe_adelo",  "x, z, s",3),
	("Marque a alternativa que contém palavra grafada incorretamente.", "ezilar",3),
	("Marque a alternativa que contém palavra grafada incorretamente.", "paraízo", 3),
	("Assinale a alternativa em que todos os vocábulos estejam grafados corretamente: C ou Ç.", "cinco, carroça, paçoca.", 4), 
	("Dos grupos de palavras abaixo o único que não contém palavras se escreve com ss é:", "ássido, senssacional. Compreenssão.", 4),
	("Somente uma alternativa contém palavras grafadas corretamente:", "revivesço, excrescência ,excursão.", 4),
	("São escritas com ss , sç e sc respectivamente:", "antissocial, enrubesço ,fascículo.", 4),
	("Qual alternativa não contém palavras escritas com xc?", "excavação, excritório,excorbuto.", 4),
	("Somente uma alternativa está incorreta", "susseder, inescedível,essído.", 4),
	("A alternativa em que todas as palavras são grafadas com ss é:", "apatossauro, alvissareiro, assembleia.", 4),
	("A_____ dos_________ é __________", "descrença, associados, indesculpável.", 4),
	("A __________ da_________ de calouros__________ no último semestre.", "indisciplina, classe, decresceu.", 4),
	("___________,_________________ e ______________ fazem parte da minha infância.", "paçoca, bagunça, preguiça", 4),
	("A___________ para  __________ foi ______________.", "excursão, Assunção, cancelada", 4),
	("___________ para ir ao_____________ .", "consertei, concerto", 4),
	("O ________  teria ____________ à__________.", "ascensorista, comparecido, sessão", 4),
	("Somente uma alternativa não contém palavras grafadas com C.", "cistema, cinusite, cíntese", 4),
	("Assinale a série em que todas as palavras devam ser escritas com m.", "intercâ_bio, a_pere",5),
	("Assinale a série em que todas as palavras devam ser escritas com n.", "lo_tra, a_fíbio",5),
	("Marque o item cujos vocábulos devem ser grafados com a letra indicada entre parênteses.", "u_tar, u_ção, vi_co (n)",5),
	("Em qual das opções m preenche todas as lacunas?", "e_prestar, se_pre",5),
	("Em qual das opções n preenche todas as lacunas?", "Pi_go, cime_to",5),
	("Assinale a opção que contém erro de ortografia.", "Utemsílio",5),
	("Assinale a opção que todas as palavras estão escritas corretamente.", 	"Ambientalista, Caxumba",5),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Botequin",5),
	("Assinale a opção que contém palavra grafada incorretamente.", "Comstante",5),
	("Preencha os espaços com m ou n para que os vocábulos fiquem escritos corretamente e marque a sequência correta: Ro_da, Incê_dio, I_peratriz, 	A_bidestro", "n, n, m, m",5),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Onbudsman",5),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Tanbor",5),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Fimcar",5),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Enpalidecer",5),
	("Assinale a alternativa em que todos os vocábulos estejam grafados corretamente: R ou RR.", "carretel, carruagem, corrimão.", 6),
	("Dos grupos de palavras abaixo o único que não contém palavras escritas com r é:" , "baril, bareiro, barote.", 6),
	("Somente uma alternativa contém palavras grafadas corretamente:", "Marrocos, alforria, surreal.", 6),
	("São escritas com rr, r,rr respectivamente:", "atarraxar, rouxinol, carreteiro.", 6),
	("Qual alternativa contém APENAS palavras escritas com r?", "honra, rosa, genro.", 6),
	("Somente uma alternativa está incorreta", "Corida, corimento, coreção.", 6),
	("A alternativa em que todas as palavras são grafadas com R é:", "honra, genro, reforço", 6),
	("O______ onde_______ tem um lindo_____.", "arraial, moro, morro.", 6),
	("O __________ da escola de samba_________ do __________ é_________.", "enredo, guerreiros, arrebol, arrebatador", 6),
	("A ___________dos escravos_________________ um ______________ cruel.", "alforria, corrigiu, erro", 6),
	("O __________________ é uma__________para a nação.", "corrupto, desonra", 6),
	("O _____ de_________ é ______.", "arroz, carreteiro, horrível.", 6),
	("Minha mão está___________ porque acertei a_____________ nela.", "amarrada, marreta.", 6),
	("O ________ mora no ______________ do ____________ ", "corretor, arranha-céu, bairro.", 6),
	("Somente uma alternativa não contém palavras grafadas com rr.", "enrredo, honrra, genrro.", 6),
	("Assinale a série em que todas as palavras devam ser escritas com i.", "D_ante, d_spêndio, júr_",7),
	("Assinale a série em que todas as palavras devam ser escritas com e.", "C_dilha, ár_a, _mbutir",7),
	("Marque o item cujos vocábulos devem ser grafados com a letra indicada entre parênteses.", "T_stemunha, san_ar, _ncômio (e)",7),
	("Em qual das opções i preenche todas as lacunas?", "Acrimôn_a, prem_ar",7),
	("Em qual das opções a vogal ‘e’ preenche todas as lacunas?", "_ndireitar, s_não",7),
	("Assinale a opção que contém erro de ortografia.", "siringueiro",7),
	("Assinale a opção que uma das palavras estão escritas incorretamente.", "Cerciar, discrição",7),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Siringa",7),
	("Assinale a opção que contém palavra grafada incorretamente.", "Palavriado",7),
	("Marque a sequência que completa os espaços com i ou e, para que os vocábulos 	fiquem escritos corretamente: arr_piar, p_ão, errôn_o", "e, e, e",7),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Antivéspera",7),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Caristia",7),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Presencear", 7),
	("Marque a alternativa que contém palavra grafada incorretamente.", "Encrustar",7),
	("Assinale a alternativa em que todos os vocábulos estejam grafados corretamente: U ou O.", "acudir, cúpula, botequim", 8),
	("Dos grupos de palavras abaixo o único que não contém palavras escritas com O é:", "entopir, choviscar, ortiga", 8),
	("Somente uma alternativa contém palavras grafadas corretamente:", "súmula, bueiro, pontual", 8),
	("São escritas com L , U e L respectivamente:", "anel, saúde, amável", 8),
	("Qual alternativa não contém palavras escritas com O?", "mandíbola, jaboti, cotucar", 8),
	("Somente uma alternativa está incorreta", "curtiça, tralma, trofél", 8),
	("A alternativa em que todas as palavras são grafadas com L é:", "pessoal, impossível, altura", 8),
	("O______    ________ fica  lado do _______", "quartel, general, hospital", 8),
	("A professora__________quando_______um________.", "desmaiou, viu, camundongo", 8),
	("___________é a_________________ e ______________ é o time de futebol.", "Curitiba, capital, Coritiba", 8),
	("____um_________ ontem e agora está_________", "caiu, temporal, chuviscando.", 8),
	("O_________ é uma arma_______", "revólver, letal.", 8),
	("_________ por não _______ o ________.", "obrigado, cutucar, animal", 8),
	("O ________ do Panamá  serve de passagem para____________ mercantes.", "canal, navios", 8), 
	("Somente uma alternativa não contém palavras grafadas com O.", "embotir, taboa, usofruto", 8);


  

-- INSERIR AS ALTERNATIVAS SEM AS LETRAS a) b) c)
INSERT INTO Alternativas (alternativa, codTeste) VALUES 
	("_iló, _esus, gara_em", 1),
	("_irau, _ente, _eito",1),
	("Laran_eiro, _egue, _ibóia",1),
	("Lison_ear, lo_ista, vir_em",1),
	("Tra_e, ma_estade, _ejum",2),
	("Vare_ista, sar_eta, _irassol",2),
	("_engibre, _irino, ad_etivo",2),
	("_eléia, massa_em, li_eiro",2),
	("Man_ericão, gor_eta, mon_e (j)",3),
	("Ferru_em, farin_e, o_iva (g)",3),
	("A_iota, cora_em, su_eira (g)",3),
	("Pa_e, can_ica, ti_ela (j)",3),
	("Co_itar, al_ema",4),
	("Re_eitar, la_ear",4),
	("Cerei_eira, no_ento",4),
	("Va_em, ultra_e",4),
	("_esuíta, a_eitar, _irino",5),
	("Lambu_em, _egue, tre_eito",5),
	("_enipapo, ori_em, sar_ento",5),
	("_inecologista, está_io, malandra_em",5),
	("Ojeriza",6),
	("Geada",6),
	("Bege",6),
	("Mangedoura",6),
	("Magestade",7),
	("Vadiajem",7),
	("Jerimum",7),
	("Cafageste",7),
	("Vagem",8),
	("Varegista",8),
	("Gericó",8),
	("Enjessar",8),
	("Gejum",9),
	("Jirau",9),
	("Ultrage",9),
	("Bobajem",9),
	("j, g, j",10),
	("j, j, j",10),
	("j, j, j",10),
	("J, j, g",10),
	("Jênese",11),
	("Prestíjio",11),
	("Refúgio",11),
	("Mejera",11),
	("Jiz",12),
	("Gíria",12),
	("Lijeiro",12),
	("Jim",12),
	("Gimnosperma",13),
	("Evanjelho",13),
	("Jeléia",13),
	("Mirajem",13),
	("Sujestão",14),
	("Serjipe",14),
	("Angioplastia",14),
	("Prodíjio",14),
	("Genjiva",15),
	("Jêsso",15),
	("Vertigem",15),
	("Hereje",15),
	("chafariz, pixe, pexa", 16),
	("xeque, salsixa, esquixo",16),
	("xuxu, puxar, cochichar",16),
	("muxoxo, chispa, xangô",16),
	("chacina, chalé, chamego",17),
	("achar, desfecho, chique",17),
	("chuchu, chapéu, tacha",17),
	("froucho, cherife, chavante.",17),
	("enxaqueca, xegar, caximbo",18),
	("almoxarife, xarco, chereta",18),
	("abacaxi, chofer, piche.",18),
	("arroxo, coaxar, troucha", 18),
	("rancho, salsixa, rouchinol",19),
	("mecher, pachorra, chará", 19),
	("preencher, atarraxar, chuviscando",19),
	("gueixa, caixa,chamar", 19),
	("boxexa, xocalho, xícara",20),
	("vexame, xoupana, xafariz",20),
	("baxaréu, enxente, moxila",20),
	("caixa, abacaxi, xará",20),
	("xaxim, chinfrim, deboche.",21),
	("xamego,  brocha, laxante",21),
	("baixa, xavante, chope.",21),
	("linchar, chulo, chafurdar.",21),
	("murchar, pechincha, mecha.", 22),
	("faicha, machiche, prache",22),
	("changô, enchada, enchergar",22),
	("encherido, enchugar, puchar",22),
	("chavante, xacina, Xingu", 23),
	("xavante, xacina, Chingu",23),
	("xavante, chacina, Xingu",23),
	("chavante, chacina, Chingu",23),
	("chocalho, cheio, seixos.", 24),
	("xocalho, xeio, seixos.",24),
	("chocalho, cheio, seichos.",24),
	("Chocalho, xeio, seixos.",24),
	("charope, chá, cochilo", 25),
	("xarope, xá, cochilo", 25),
	("charope, chá, cochilo", 25),
	("xarope, chá, cochilo.", 25),
	("tacha, taxo, Chapada", 26),
	("tacha, tacho, Chapada",26),
	("taxa, taxo, Xapada",26),
	("taxa, tacho, chapada", 26),
	("cherife, Chenófobo, chingar.", 27),
	("xerife, xenófobo, xingar.", 27),
	("xerife, xenófobo, chingar", 27),
	("xerife, chenóbo, xingar.", 27),
	("inxada, enchada.", 28),
	("inchada, enxada.", 28),
	("inchada, enchada.", 28),
	("inxada, enxada.", 28),
	("chefe, almocharido, achincalhado, faxineiro.", 29),
	("xefe, almoxarifado, axincalhado, faxineiro.", 29),
	("chefe, almocharidao, achincalhado, fachineiro.", 29),
	("chefe, almoxarifado, achincalhado, faxineiro.", 29),
	("xerocópia, xexéu, xícara", 30),
	("caixilho, gueixa, xaxim.", 30),
	("xiste, linxar, xiado.", 30),
	("enxotar, rouxinol, atarraxar.", 30),
	("E_ecutivo, e_ilio, proe_a", 31),
	("Tran_itar, ob_équio, e_agero",31),
	("E_ótico, e_alar, ê_odo",31),
	("Ê_ito, tran_a, análi_e",31),
	("A_eite, a_ar, ami_ade",32),
	("Cri_e, pesqui_ar, catequi_ar",32),
	("A_ilo, ca_aco, u_uário",32),
	("Arma_enagem, aran_el, pe_ado",32),
	("E_austo, e_imir, rai_",33),
	("Quero_ene, i_olar, anto_oário",33),
	("Aga_alho, avi_o, deci_ão",33),
	("Catali_ador, dure_a, bu_ina",33),
	("Certe_a, pe_o, coli_ão (s)",34),
	("E_orbitante, e_emplo, e_istência (x)",34),
	("E_onerar, Arbori_ado, u_ina (z)",34),
	("Corte_ia, defe_a, e_ilar (s)",34),
	("E_ibir, e_ato, e_orcista",35),
	("E_altar, do_e, conclu_ão",35),
	("Tran_ando, coali_ão, e_igente",35),
	("E_aminar, e_istencial, arabi_ar",35),
	("Vi_ita, te_oura, utili_ar",36),
	("Bele_a, de_enhar, a_iático",36),
	("Ca_amento, ba_e, ro_eira",36),
	("Aprendi_agem, Alfa_ema, timide_",36),
	("Curio_idade, fa_e, me_ada",37),
	("Araça_eiro, ba_ar, ca_o",37),
	("Vi_inho, pe_ar , u_o",37),
	("Corte_ia, pre_ídio, nature_a",37),
	("desejo",38),
	("luzo",38),
	("Amazona",38),
	("executar",38),
	("Esuberância, exército",39),
	("Exemplar, fasendeiro",39),
	("Despeza, vigésimo",39),
	("Surpresa, tesouro",39),
	("besouro",40),
	("crise",40),
	("algazarra",40),
	("esacerbar",40),
	("esasperação", 41),
	("exaurir",41),
	("executar",41),
	("exuberante",41),
	("x, z, z",42),
	("s, z, s",42),
	("z, z, s",42),
	("x, z, s",42),
	("execrável",43),
	("exercer",43),
	("ezilar",43),
	("exequível",43),
	("existir",44),
	("aprendizado",44),
	("presa",44),
	("paraízo",44),
	("cacife, acude, coçeira", 45),
	("cinco, carroça, paçoca.", 45),
	("çebola, diçionário, caçapa.",45),
	("cinema, alsapão, coceira.",45),
	("assassino, acessar, assaz", 46),
	("assecla, assoberbar, associado.", 46),
	("assente, assombro, assepsia.", 46),
	("ássido, senssacional. Compreenssão.", 46),
	("escludente, esceção,sussessivo.", 47),
	("revivesço, excrescência ,excursão.", 47),
	("farça, exceço,escepcional.", 47),
	("efervesça, indisfarssável,presunçoso.", 47),
	("agressivo, absseço, ascepsia.", 48),
	("antissocial, enrubesço ,fascículo.",48),
	("decresser, aquiesço ,ascincrono.", 48),
	("esserto ,desça, escremento.", 48),
	("excedente, exclamativo, excerto.", 49),
	("excipiente, excursionar, excelso.", 49),
	("excavação, excritório,excorbuto.", 49),
	("excluir, excitação, exceder.", 49),
	("cebola, lignificação, sabatina.", 50),
	("inverossimilhança,  excerto, renasçais.", 50),
	("sacarose, descaroçador, sexcentésimo.", 50),
	("susseder, inescedível,essído.", 50),
	("assimetria, mássimo, resvaladisso.", 51),
	("inafianssável, fronteirisso, assegurar.", 51),
	("apatossauro, alvissareiro, assembleia.", 51),
	("concupissente, fassinar, fassismo.", 51),
	("descrenssa, assossiados,indesculpável.", 52),
	("descrença, asosciados, indesculpável.", 52),
	("descrença, açossiados, indesculpável.", 52),
	("descrença, associados, indesculpável.", 52),
	("indissiplina, clase, descresseu.", 53),
	("indiciplina, classe, decresçeu.", 53),
	("indisciplina, classe, decresceu.", 53),
	("indisciplina, clasce, decreseu.", 53),
	("pasoca, bagunça, preguissa", 54),
	("passoca, bagunça, preguisça", 54),
	("paçoca, bagunsa, preguiça", 54),
	("paçoca, bagunça, preguiça", 54),
	("excursão, Assunção, cancelada", 55),
	("escurssão,Açunssão, canscelada", 55),
	("escurssão, Asunssão, cancelada", 55),
	("excurção,Asunsção, cancelada", 55),
	("concertei, conserto", 56),
	("concertei, concerto", 56),
	("consertei, conserto", 56),
	("consertei, concerto", 56),
	("assenssorista,comparesido,sessão", 57),
	("ascensorista, comparecido, sessão", 57),
	("acensorista, comparescido, seção", 57),
	("assençorista, compreçido, sesção", 57),
	("cinema, cacife, cacique.", 58),
	("cistema, cinusite, cíntese", 58),
	("cisterna, civil, precisar.", 58),
	("cítrico, cegueira, cipreste.", 58),
	("a_pola, la_che",59),
	("pi_to, e_purrão",59),
	("intercâ_bio, a_pere",59),
	("â_bito, fu_go",59),
	("lâ¬_pada, u_bigo",60),
	("mu_do, pudi_",60),
	("lo_tra, a¬_fíbio",60),
	("a_tônimo, e_proar",60),
	("u_tar, u_ção, vi_co (n)",61),
	("ju_co, i_plicar, a_brosia (m)",61),
	("i_portante, jama_ta, i_terprete (m)",61),
	("o_tem, a_bulatório, to_to (n)",61),
	("ame_doim, lara_ja",62),
	("ba_da, co_putador",62),
	("a_ta, ca_po",62),
	("e_prestar, se_pre",62),
	("A_putação, bo_bons",63),
	("U_bilica, bi_go",63),
	("A_plie, ca_to",63),
	("Pi_go, cime_to",63),
	("Antídoto",64),
	("Concha",64),
	("Utemsílio",64),
	("Imperador",64),
	("Contraste, Lamce",65),
	("Onda, Anparar",65),
	("Ambientalista, Caxumba",65),
	("Emtupido, Ombreira",65),
	("Grampo",66),
	("Botequin",66),
	("Camboriú",66),
	("Donzela",66),
	("Empacotadora",67),
	("Ambíguo",67),
	("Comstante",67),
	("Manga",67),
	("n,n, n, m",68),
	("m, n, m, m",68),
	("n, n, m, m",68),
	("n, m, n, m",68),
	("Ampliar",69),
	("Onbudsman",69),
	("Ambicioso",69),
	("Companheiro",69),
	("Tanbor",70),
	("Ambivalência",70),
	("Manta",70),
	("Pronto",70),
	("Dente",71),
	("Bronca",71),
	("Fungo",71),
	("Fimcar",71),
	("Índio",72),
	("Enpalidecer",72),
	("Bambu",72),
	("Também",72),
	("barracão, buraco, caroça.", 73),
	("serote, cerrado, encerradeira",73),
	("carretel, carruagem, corrimão.",73),
	("corida, coragem, garote.", 73),
	("rato, roupa, rua", 74),
	("Ricardo, real, rede", 74),
	("baril, bareiro, barote.", 74),
	("rápido, rouco, raso.", 74),
	("aranha, honrra, Maranhão.", 75),
	("jara,  fara, gara.", 75),
	("Marrocos, alforria, surreal.", 75),
	("arrocho,corrupto,genrro.", 75),
	("pachorra, rancho, genrro.", 76),
	("enrraizar, arancar,ferrugem.", 76),
	("atarraxar, rouxinol, carreteiro.", 76),
	("honrroso,horível, arretado.", 76),
	("araigado, antiderapante, amenoreia.", 77),
	("honra, rosa, genro.", 77),
	("araial, corigir, arasar.", 77),
	("arabalde, amarotar, desfora.", 77),
	("Roque, alfarrabista, aguarrás.", 78),
	("Alcaparra, correio, remetente.", 78),
	("razão, surreal, recomenda.", 78),
	("Corida, corimento, coreção.", 78),
	("mareta, maruá, marom", 79),
	("honra, genro, reforço", 79),
	("bero, erado, aruaceiro.", 79),
	("guerra, garafa, soriso.", 79),
	("arraial. Morro, moro.", 80),
	("arraial, moro, moro.", 80), 
	("arraial, moro, morro.", 80),
	("arraial, moro, morro.", 80),
	("enrredo, guerreiros, arebol, arebatador", 81),
	("enredo, guerreiros, arrebol, arrebatador", 81),
	("enredo, guereiros, arebol, arrebatador", 81),
	("enrredo, guerreiros, arebol, arebatador", 81),
	("alforia, corigiu, erro", 82),
	("alforria, corigiu, erro", 82),
	("alforria, corrigiu, erro", 82),
	("alforia, corrigiu, erro", 82),
	("corrupto, desonra", 83),
	("corrupto, desonrra", 83),
	("corupto, desonra", 83),
	("corupto, desonrra", 83),
	("aroz, careteiro, horível", 84),
	("arroz, careteiro, horrível", 84),
	("arroz, careteiro, horível", 84),
	("arroz, carreteiro, horrível.", 84),
	("amarada, mareta", 85),
	("amarada, marreta.", 85),
	("amarrada, mareta.", 85),
	("amarrada, marreta.", 85),
	("coretor, aranha-céu, bairo", 86),
	("coretor, arranha-céu, bairro.", 86),
	("corretor, arranha-céu, bairro.", 86),
	("corretor, aranha-céu, bairro.", 86),
	("aborrecer, arrastão, erroneamente.", 87),
	("surreal, amarrotar, barraca.", 87),
	("desforra, corroborar, corrigir.", 87),
	("enrredo, honrra, genrro.", 87),
	("D_spender, s_quer, d_stinguir",88),
	("D_ante, d_spêndio, júr_",88),
	("_ntonação, betum_, hast_ar",88),
	("Remed_ar, _nclinar, fals_ar",88),
	("D_storção, _ntitular, _ntremear",89),
	("Víd_o, prev_nir, _nfestar",89),
	("C_dilha, ár_a, _mbutir",89),
	("Calcár_o, _mbuir, granj_ar",89),
	("Bor_al, d_spesa, pr_vilégio (e)",90),
	("_ndigitar, requ_sito, oc_ano (i)",90),
	("T_stemunha, san_ar, _ncômio (e)",90),
	("Acar_ar, cord_al, fem_nino (i)",90),
	("Acrimôn_a, prem_ar",91),
	("In_gualável, _numerar",91),
	("Def_rir, m_noridade",91),
	("Card_al, d_lapidar",91),
	("_rrupção, nom_ar",92),
	("_ndireitar, s_não",92),
	("Aér_o, mer_tíssimo",92),
	("D_scricionário, d_sigual",92),
	("chefiar",93),
	("sentenciar",93),
	("empecilho",93),
	("siringueiro",93),
	("Cerciar, discrição",94),
	("Preferir, passeata",94),
	("Inquirir, iniludível",94),
	("Ansiar, receoso",94),
	("Siringa",95),
	("Demitir",95),
	("Rarear",95),
	("Frontispício",95),
	("Homogêneo",96),
	("Legítimo",96),
	("Palavriado",96),
	("Quase",96),
	("e, i, i",97),
	("i, i, i",97),
	("e, e, e",97),
	("e, i, e",97),
	("Desfrutar",98),
	("Área",98),
	("Descortinar",98),
	("Antivéspera",98),
	("Caristia",99),
	("Indeferir",99),
	("Elucidar",99),
	("Artifício",99),
	("Aborígine",100),
	("Miscigenação",100),
	("Presencear",100),
	("Verossímil",100),
	("Parcimônia",101),
	("Acreano",101),
	("Escárnio",101),
	("Encrustar",101),
	("custume, buate, guela", 102),
	("jaboticaba, taboa, embotir", 102),
	("acudir, cúpula, botequim", 102),
	("engulir, bolir, boeiro", 102),
	("mágoa, nódoa, focinho", 103),
	("toalete, tossir, tostão", 103),
	("explodir, marajoara, mochila.", 103),
	("entopir, choviscar, ortiga", 103),
	("postau, formau, letau.", 104),
	("pnel, cáuculo,chapél", 104),
	("víros, usofruto, vírgola.", 104),
	("súmula, bueiro, pontual", 104),
	("varal, faróu, atel", 105),
	("anel, saúde, amável", 105),
	("tambal, cordeu,xexel", 105),
	("calma, auma, tralma", 105),
	("mandíbola, jaboti, cotucar", 106),
	("amêndoa, engolir, goela.", 106),
	("comprido, costume, ocorrência.", 106),
	("polenta, mosquito, toalete.", 106),
	("pitoresco, proeza, romeno", 107),
	("curtiça, tralma, trofél", 107),
	("bule, fusível, revólver", 107),
	("hotel, granel, varal", 107),
	("aumoço, folga, túnel", 108),
	("pessoal, impossível, altura", 108),
	("estorol, bal, queimol", 108),
	("cruel, chamol, falol", 108),
	("quartel,  general, hospitau", 109),
	("quarteu ,general, hospital", 109),
	("quartel, generau, hospitau", 109),
	("quartel, general, hospital", 109),
	("desmaiol, vio, camondongo", 110),
	("desmaiou, viu, camodongo", 110),
	("desmaiou, viu, camundongo", 110),
	("desmaioul, viu, camundongo", 110),
	("Coritiba, capital, Curitiba", 111),
	("Curitiba, capital, Coritiba", 111),
	("Coritiba, capitau, Coritiba", 111),
	("Curitiba, capital, Curitiba", 111),
	("caio, temporal, choviscando", 112),
	("caio, temporal, chuviscando", 112),
	("caiu, temporal, chuviscando.", 112),
	("cail, temporal, chuviscando", 112),
	("revóuver, letau", 113),
	("revóuver, letal", 113),
	("revólver, letau", 113),
	("revólver, letal.", 113),
	("obrigadu, cotucar, animal", 114),
	("obrigado, cutucar, animau", 114),
	("obrigado, cutucar, animal", 114),
	("obrigado, cutucar, animal", 114),
	("canal, navius.", 115),
	("canau,navius", 115),
	("canal, navios", 115),
	("canal, navius", 115),
	("comprido, costume, silvícola", 116),
	("embotir, taboa, usofruto", 116),
	("focinho, goela, encobrir", 116),
	("tostão, zoar, bobina", 116);


INSERT INTO GrupoTeste (grafemas) VALUES
	("1_2"),
	("3_4"),
	("5_6"),
	("7_8"),
	("1_3_5_7"),
	("2_4_6_8"),
	("total"),
	("-total");

INSERT INTO Texto (textoIncompleto) VALUES 
  	("Andreia acordou com sede e decidiu se levantar e ir até a _eladeira. Fazia alguns dias que ela não conseguia pegar no sono, desde que escorregou no _ardim enquanto fazia
	fa_ina. Ao _egar na cozinha se deparou com algo que a dei_ou de quei_o caído: uma _iboia enorme, que parecia ter acabado de comer um boi. A moça pensou que fosse uma mira_em, mas antes que pudesse pensar em qualquer coisa, o 	bi_o avançou na sua direção
	e, de repente, deu o bote. Esbaforida, Andreia acordou suando _elado, sentindo muita sede, mas preferiu não arriscar."),
	("No zoológico a vida seguia normalmente, os macacos pulando, o leão ru_indo, e a _irafa entediada, como sempre reclamando da vida. Um dia, pousou na sua _aula e começou a cantar. Aquela melodia foi deixando a nossa amiga cada vez mais _ateada, até que ela não aguentou mais e começou a _ingar:
	- Ei, passarinho _arope, vá _eretar em outro lugar!
	- Acalme-se, minha amiga man_ada. Pare de se quei_ar e aprenda a ver o lado bom da vida! Disse o pássarinho.
	- Que lado bom? – Respondeu a pescoçuda – Olhe para mim, presa sem ter cometido crime algum...
	- E quem cometeu essa in_ustiça com você, minha querida? – Perguntou o pássaro.
	- Foram aqueles que vem aqui me visitar. Parece que eles não veem beleza na liberdade. Coitados, eles também vivem presos."),
	("- Não adianta, _ará! O _uiz marcou tá marcado...
	- Mas eu nem encostei no _ogador adversário, só na _abulani.
	- Dei_a isso pra lá, cara. Já passou. O importante é que demos um _ocolate nos caras, estamos com um pé na final.
	- É que eu queria tanto _ogar o próximo jogo, em casa, diante da torcida. Inclusive eles devem ter me _ingado um bocado, hein?
	- É,  devem mesmo. Mas poderia ser pior se tivéssemos dado um ve_ame aqui. 
	- Você está certo, vou a_eitar minhas coisas. Valeu!"),
	("Na fa_enda, uma vi_ita deixou todos espantados.
	Um homem e_igia que o seu Epaminondas paga_e pelo seu boi que havia morrido nas terras do velho. Ele esbravejava, em um tom agre_ivo:
	- Maldito seja vo_ê e sua de_endência, Epaminondas! Quero ser ressar_ido!
	- Deixe de inquieta_ão, meu bom homem. Sente-se, vamos falar sobre isso. Menos e_itação, por favor...
	Então o homem se aquietou. Falaram por horas e, enfim, chegaram a um acordo.
	- Quanto vamos ter que pagar a ele, Epaminondas? – Disse dona Antonieta, sua esposa.
	- Nada. Ele era um enganador e eu o desmascarei.
	- Mas como descobriu isso, Epaminondas?
	- Perguntei a ele qual o tamanho da ferradura do boi. Ele respondeu que era tamanho 15. Mas boi não usa ferradura, eu falei. Ele ficou com vergonha e foi embora."),
	("Há muita bele_a nas avenidas da _idade.
	Muitas ve_es nem notamos esta linda pai_agem.
	São lugares fa_inantes, cheios de novidade.
	Só per_ebe quem repara quando se está de pa_agem.
	Só para dar um e_emplo: já reparou na quantidade
	De lu_inhas correndo ligeiras nos carros em ultrapa_agem?"),
	("Maravilhas do Mundo Antigo
	Eis uma lista bem intere_ante daquelas que foram con_ideradas as constru_ões e obras mais belas e e_uberantes da Antiguidade Clá_ica:
	1 – Pirâmide de Quéops
	2 – Jardins Suspen_os da Babilônia
	3 – Estátua do deus grego _eus em Olímpia
	4 – Tempo de Ártemis em Éfe_o
	5 – Mausoléu de Halicarna_o
	6 – Colo_o de Rodes
	7 – Farol de Alexandria"),
	("Foi de a_epiar!  o time de basquete de Itapipoca do Leste 
	ve_ceu todos os adversários e se sag_ou ca_peão da Copa Ame_doin. 
	A_tônio, camisa 99 e ala da equipe,  foi o g_ande po_tuador da co_petição, 
	com 237 po_tos."),
	("Na doce_ia, Carlos diz para Aninha:
	- Você quer uns bo_bons, Aninha?
	- Não sei, Carlos. Acho que p_efiro um pudi_.
	- Tá ce_to. Vou pedi_ um doce de lara_ja.
	A balconista diz:
	- Porque vocês não experime_tam nosso doce de ma_ga? É uma delícia!
	- Nossa, amo esse doce! Hoje vou me acabar com todas essas guloseimas! – diz Aninha.
	- Não coma muito, Aninha! Senão você não almoça.
	- Ah! Tudo bem, vou me segurar.
	- Vamos comer logo.
	Os dois comeram muitos doces e depois co_eram para casa."),
	("Um senhor de meia idade chega na loja. O ve_dedor o _ecebe dizendo:
	- Em que posso ajudá-lo, senhor?
	- Estou que_endo por um co_putador para minha filha.
	- Ótimo! Temos máquinas muito boas aqui. Tenho que saber qual o tipo de usuá_ia é a sua filha para i_dicar a melhor co_figuração.
	- Ela quer para fazer as atividades do seu cu_so de e_genharia a_biental. Deve ser uma máquina muito boa para atender suas necessidades.
	- Certo. Vejo que o senhor entende do que está falando. Veja esta máquina, acho que vai gostar.
	Depois de analisar bem, o senhor diz:
	Gostei, vou levar."),
	("Diante de uma epidemia _minente de febre amarela, o governo deve tomar certas medidas. 
	Os postos de saúde devem receber mais s_ringas e lot_s de vacina. 
	Os agent_s devem encontrar os focos dos m_squitos, como pne_s, b_eiros e matagais. 
	A febre amarela é uma doença infecciosa febri_ aguda, causada por um arbovírus do gênero Flavivirus, da 
	família Flaviviridae. A vacina é a principa_ ferramenta de prevenção e controle da doença.Todo cuidado é 
	pouco, pois esta doença pode ser fata_. "),
	("O C_ritiba Foot Ball Club é um time de futebo_ da cidade de C_ritiba, no Paraná. Em 1905 um grupo de rapazes 
	c_ritibanos adiquiri_ uma bola e inicio_ a prática do futebo_. Em 1910 é fundado o clube, que possui trinta e 
	set_ títulos paranaens_s e dois títulos do camp_onato brasileiro da série B."),
	("Marquinhos era um m_leque c_mprido que morava na minha rua. Bom de briga, estava sempre s_ metendo em confusão. 
	O pai era s_ringueiro e a mãe era lavadeira, trabalhavam fora e o m_nino sempre aproveitava para ficar o dia todo 
	na rua. Um dia, Marquinhos fugi_ de casa para jogar bola, mas antes de chegar no campinho, escorrego_ e caiu de 
	cabeça no chão. O so_ estava rachando e o garoto levantou d_snorteado. Todo mundo ria do Marquinhos, que _ngoliu o 
	choro e foi pra casa resmungando."),
	("O sar_ento Eliomar ficou muito lison_eado com o pre_ente que recebeu da tropa. Ele, que se_pre fora e_igente e 
	que era conhecido como durão, deixou a dure_a de lado e as lágrimas caíram dos seus olhos. Desde que pediu a 
	d_pensa para tratar de uma _nfermidade motivada por um to_bo, ainda não tivera um mome_to de tamanha alegria."),
	("A in_estão de vitaminas é um fator muito i_portante para a manutenção da saúde. Os _specialistas recome_dam alimentos 
	coloridos, como va_em, tan_erina, alface, rúcula, couve-flor, entre outros. Para quem de_eja perder uns quilinhos, recome_da-se 
	beber água com gen_ibre e limão, pois são alimentos termo_ênicos, que ajudam a emagrecer, pois aumentam o gasto calórico do organismo. "),
	("As _imnospermas são plantas que vivem em a_bientes frios ou te_perados. Essas plantas possuem raí_es, caule e folhas, além de ramos com 
	folhas chamadas de estróbilos. São ve_etais e_uberantes, que não produ_em frutos. Suas seme_tes são nuas e, no caso dos pinhões das Araucárias, 
	podem ser sabor_adas em deliciosas receitas re_ionais."),
	("O _adrez como conhe_emos atualmente surgi_ no sudoeste Europe_, durante o Rena_imento. Mas as o_igens do jogo são per_as e indianas. 
	O en_adrismo é um esporte contemporâneo e para se tornar um Grande Mestre (maior níve_ na cla_ificação), é preciso passar pelos níveis 
	Mestre Nacional, Canditato a Mestre FIDE, Mestre FIDE, Mestre Internacional."),
	("Deve-se ter muito cuidado ao comprar o en_oval dos seus filhos. Muitos pais se de_etem ao ver uma vitrine _eias de sapatinhos, roupinhas 
	bonitinhas, e acabam comprando coisas desne_essárias para seus re_ém na_idos. O importante é comprar apenas o e_encial, como roupas, kits 
	de banho, toalhas, roupas de cama e banho, ca_inho de bebê, ber_o, cadei_inha, fraldas, entre outros itens."),
	("No verão sentimos uma coisa diferente, né? Aquele so_ maravilhoso dá uma vontade de ir à p_aia, _entar de frente para o mar e curtir 
	bastante. Ou de sair para acampar, armar a ba_aca, contar histórias de te_or em vo_ta da fogueira e se divertir com os amigos. No fim de 
	semana, um chu_asquinho é sempre bom, aquela carne a_ada e pi_ina à vontade. Mas não se esque_a de beber muito líquido e comer frutas"),
	("A maioria das tem em comum o uso de arco e fle_a. A seta, como também é chamada, é um projéti_ pontiagudo, geralmente disparado com um
	arco. Os dois prin_ipais usos destas armas foram, sem dúvida, a ca_a e a gue_a, mas ho_e a aqueria tornou-se um esporte muito praticado em 
	todo o mundo. Há uma infinidade de tipos de arcos, alguns industriali_ados e outros feitos à mão e, para cada categoria e_iste uma modalidade 
	_specífica de competi_ão."),
	("Cinco fatos curiosos sobre as lo_tras marinhas:
	1) Po_uem uma das pela_ens mais den_as de todo o reino anima_, tendo entre 350 000 e 1 000 000 de pelos por POLEGADA quadrada de pele.
	2) Elas são capa_es de mergulhar a mais de 100 metros de profundidade para conseguir alimento.
	3) Elas utilizam ferramentas como pedras e outros ob_etos para quebrar as con_as dos moluscos que comem.
	4) Elas in_erem de 20 a 25% de seu peso diariamente para manter a temperatura do corpo alta o bastante para resistirem ao frio das águas em que nadam.
	5) As lontras são muito importantes para o equilíbrio do ecossistema em que vivem, pois evitam que as florestas de algas marinhas sejam devastadas pelos ouri_os-do-mar.

	NASCIMENTO, Elias. Aprenda 5 fatos curiosos sobre as adoráveis lo?tras marinhas. 2015. Disponível em: <http://www.megacurioso.com.br/animais/85358-aprenda-5-fatos-curiosos-sobre-as-adoraveis-lontras-marinhas.htm>. Acesso em: 26 jan. 2017."),
	("‘o fa_ismo é uma conduta política extremamente a_toritária, marcada pelo na_ionalismo, pela militarização dos conflitos e por uma pre_cupação ob_essiva com a ideia de decadência de uma comunidade ou nação. Hosti_ às formas modernas de democracia, 
	o fa_ismo reco_e a violência, cria_do um inimigo interno e/ou externo que deve ser _xterminado para garantir a segurança e supremacia de um grupo considerado superior.’

	BETONI, Camila. Fa?ismo. Disponível em: <http://www.infoescola.com/historia/fascismo/>. Acesso em: 26 jan. 2017"),
	("‘A an_ioplastia é um pro_edimento cirúrgico pouco inva_ivo, e_pregado mais frequentemente para co_bater a obstru_ão de artérias que conduzem o fluxo sanguíneo 
	até o coração. Em gera_, é _ndicada para portadores de an_ina, que apresentam essa obstru_ão por conta do acúmulo de placas de gordura.’
	ANDREGHETO, Paula. O que é an?ioplastia 2016. Disponível em: <https://coracaoalerta.com.br/fique-alerta/o-que-e-angioplastia/>. Acesso em: 26 jan. 2017."),
	("Laran_ada especia_
	1 l de água
	1/2 _ícara de _á de açúcar
	1 pau de canela
	2 cravos da índia
	4 grãos de pimenta do reino
	1 pedaço de 2 cm de gen_ibre
	3 l de suco de laran_a
	Modo de preparo
	Misture a água com o açúcar, em uma panela e leve ao fogo
	Me_endo até disso_ver
	Junte a canela, o cravo da Índia, a pimenta do reino e o gen_ibre e ferva por 5 minutos
	Deixe esfriar e leve à geladeira por 4 horas
	Retire da geladeira, coe a calda e despreze os temperos
	Adicione o suco de laran_a à calda e misture bem
	LANES, Monique. Laran?ada especia?. Disponível em: <http://www.tudogostoso.com.br/receita/11480-laranjada-especial.html>. Acesso em: 26 jan. 2017."),
	("‘O termo ‘mer_tíssimo’ é um ad_etivo que significa 
	‘de grande mérito’. Portanto, como de regra, ele deve estar sempre acompanhado de um substantivo. 
	Sendo assim, a forma de se ref_rir é ‘mer_tíssimo juiz’, evitando o uso do vocábulo ‘mer_tíssimo’ isoladamente. 
	Em uma a_diência, se a inten_ão é citar o ma_istrado de maneira solene é correto trata-lo por ‘e_elência’ ou por ‘mer_tíssimo juiz’.’
	FERNANDES, Daniel. Curiosidade: E?elência ou Mer?tíssimo. 2015. Disponível em: <https://www.epdonline.com.br/noticias/curiosidade-excelencia-ou-meritissimo/1614>. Acesso em: 26 jan. 2017.");
	

INSERT INTO Gabarito (letraGabarito, posicao, codTexto) VALUES 
  	("g",1,1),
	("j",2,1),
	("x",3,1),
	("ch",4,1),
	("x",5,1),
	("x",6,1),
	("j",7,1),
	("g",8,1),
	("ch",9,1),
	("g",10,1),
	("g",1,2),
	("g",2,2),
	("j",3,2),
	("ch",4,2),
	("x",5,2),
	("x",6,2),
	("x",7,2),
	("ch",8,2),
	("x",9,2),
	("j",10,2),
	("x",1,3),
	("j",2,3),
	("j",3,3),
	("j",4,3),
	("x",5,3),
	("ch",6,3),
	("j",7,3),
	("x",8,3),
	("x",9,3),
	("j",10,3),
	("z",1,4),
	("s",2,4),
	("x",3,4),
	("ss",4,4),
	("ss",5,4),
	("c",6,4),
	("sc",7,4),
	("c",8,4),
	("ç",9,4),
	("x",10,4),
	("z",1,5),
	("c",2,5),
	("z",3,5),
	("s",4,5),
	("sc",5,5),
	("c",6,5),
	("ss",7,5),
	("x",8,5),
	("z",9,5),
	("ss",10,5),
	("ss",1,6),
	("s",2,6),
	("ç",3,6),
	("x",4,6),
	("ss",5,6),
	("s",6,6),
	("z",7,6),
	("s",8,6),
	("ss",9,6),
	("ss",10,6),
	("rr",1,7),
	("n",2,7),
	("r",3,7),
	("m",4,7),
	("n",5,7),
	("n",6,7),
	("r",7,7),
	("n",8,7),
	("m",9,7),
	("n",10,7),
	("r",1,8),
	("m",2,8),
	("r",3,8),
	("m",4,8),
	("r",5,8),
	("r",6,8),
	("r",7,8),
	("n",8,8),
	("n",9,8),
	("rr",10,8),
	("n",1, 9),
	("r",2,9),
	("r",3,9),
	("m",4,9),
	("r",5,9),
	("n",6,9),
	("n",7,9),
	("r",8,9),
	("n",9,9),
	("m",10,9),
	("i",1,10),
	("e",2,10),
	("e",3,10),
	("e",4,10),
	("o",5,10),
	("u",6,10),
	("o",7,10),
	("l",8,10),
	("l",9,10),
	("l",10,10),
	("o",1,11),
	("l",2,11),
	("u",3,11),
	("u",4,11),
	("u",5,11),
	("u",6,11),
	("l",7,11),
	("e",8,11),
	("e",9,11),
	("e",10,11),
	("o",1,12),
	("o",2,12),
	("e",3,12),
	("e",4,12),
	("e",5,12),
	("u",6,12),
	("u",7,12),
	("l",8,12),
	("e",9,12),
	("e",10,12),
	("g",1,13),
	("j",2,13),
	("s",3,13),
	("m",4,13),
	("x",5,13),
	("z",6,13),
	("i",7,13),
	("e",8,13),
	("m",9,13),
	("n",10,13),
	("g",1,14),
	("m",2,14),
	("e",3,14),
	("n",4,14),
	("g",5,14),
	("g",6,14),
	("s",7,14),
	("n",8,14),
	("g",9,14),
	("g",10,14),
	("g",1,15),
	("m",2,15),
	("m",3,15),
	("z",4,15),
	("g",5,15),
	("x",6,15),
	("z",7,15),
	("n",8,15),
	("e",9,15),
	("g",10,15),
	("x",1,16),
	("c",2,16),
	("u",3,16),
	("u",4,16),
	("sc",5,16),
	("r",6,16),
	("s",7,16),
	("x",8,16),
	("l",9,16),
	("ss",10,16),
	("x",1,17),
	("rr",2,17),
	("ch",3,17),
	("c",4,17),
	("c",5,17),
	("sc",6,17),
	("ss",7,17),
	("rr",8,17),
	("ç",9,17),
	("r",10,17),
	("l",1,18),
	("r",2,18),
	("s",3,18),
	("rr",4,18),
	("rr",5,18),
	("l",6,18),
	("rr",7,18),
	("ss",8,18),
	("sc",9,18),
	("ç",10,18),
	("ch",1,19),
	("l",2,19),
	("c",3,19),
	("ç",4,19),
	("rr",5,19),
	("j",6, 19),
	("z",7,19),
	("x",8,19),
	("e",9,19),
	("ç",10,19),
	("n",1,20),
	("ss",2,20),
	("g",3,20),
	("s",4,20),
	("l",5,20),
	("z",6,20),
	("g",7,20),
	("ch",8,20),
	("g",9,20),
	("ç",10,20),
	("sc",1,21),
	("u",2,21),
	("c",3,21),
	("o",4,21),
	("s",5,21),
	("l",6,21),
	("sc",7,21),
	("rr",8,21),
	("n",9,21),
	("e",9,21),
	("g",1,22),
	("c",2,22),
	("s",3,22),
	("m",4,22),
	("m",5,22),
	("ç",6,22),
	("l",7,22),
	("i",8,22),
	("g", 9,22),
	("ç",10,22),
	 ("j",1,23),
	("l",2,23),
	("x",3,23),
	("ch",4,23),
	("g",5,23),
	("j",6,23),
	("x",7,23),
	("l",8,23),
	("g",9,23),
	("j",10,23),
	 ("i",1,24),
	("j",2,24),
	("e",3,24),
	("i",4,24),
	("i",5,24),
	("u",6,24),
	("ç",7,24),
	("g",8,24),
	("x",9,24),
	("i",10,24);



INSERT INTO GrafemaTexto (codGrafema, codTexto) VALUES 
	(1,1),
	(2,1),
	(1,2),
	(2,2),
	(1,3),
	(2,3),
	(3,4),
	(4,4),
	(3,5),
	(4,5),
	(3,6),
	(4,6),
	(5,7),
	(6,7),
	(5,8),
	(6,8),
	(5,9),
	(6,9),
	(7,10),
	(8,10),
	(7,11),
	(8,11),
	(7,12),
	(8,12),
	(1,13),
	(3,13),
	(5,13),
	(7,13),
	(1,14),
	(3,14),
	(5,14),
	(7,14),
	(1,15),
	(3,15),
	(5,15),
	(7,15),
	(2,16),
	(4,16),
	(6,16),
	(8,16),
	(2,17),
	(4,17),
	(6,17),
	(8,17),
	(2,18),
	(4,18),
	(6,18),
	(8,18),
	(1,19),
	(2,19),
	(3,19),
	(4,19),
	(5,19),
	(6,19),
	(7,19),
	(8,19),
	(1,20),
	(2, 20),
	(3, 20),
	(4, 20),
	(5, 20),
	(6, 20),
	(7, 20),
	(8, 20),
	(1,21),
	(2, 21),
	(3, 21),
	(4, 21),
	(5, 21),
	(6, 21),
	(7, 21),
	(8, 21),
	(1,22),
	(2, 22),
	(3, 22),
	(4, 22),
	(5, 22),
	(6, 22),
	(7, 22),
	(8, 22),
	(1,23),
	(2, 23),
	(3, 23),
	(4, 23),
	(5, 23),
	(6, 23),
	(7, 23),
	(8, 23),
	(1,24),
	(2, 24),
	(3, 24),
	(4, 24),
	(5, 24),
	(6, 24),
	(7, 24),
	(8, 24);


INSERT INTO Palavra (enunciado, letraGabarito, palavraIncompleta, palavraCompleta, codGrafema,justificativa) VALUES
("Arrumem; coloquem; consertem; Pôr em boa ordem; dispor.", "j", "Arran_ar", "Arranjar", 1,"Escrito com j, formas verbais terminadas em -jar ou -jear."),
("Emitir sons melodiosos, trilar, canto dos pássaros", "j", "Gor_ear", "Gorjear", 1,"Escrito com j, formas verbais terminadas em -jar ou -jear."),
("Deslocamento de um lugar para outro.", "j", "Via_ar", "Viajar", 1, "Escrito com j, formas verbais terminadas em -jar ou -jear."),
("Planta de deliciosa fragrância, e suas folhas são muito usadas como tempero na culinária.", "j", "Man_ericão", "Manjericão", 1, "Vem do árabe al habaqa."), 
("Sentir-se bem querido por alguma atitude alheia. Envaidecido, agradecido.", "j", "Lison_eado", "Lisonjeado", 1, "Vem do Latim Laudemia."),
("Local onde se guarda veículos.", "g", "Gara_em", "Garagem", 1, "Escrito com g, diante dos substantivos terminados em: -agem, -igem e -ugem."), 
("Que revela nobreza, gravidade; altivez.", "j", "Ma_estoso", "Majestoso", 1, "Major vem do Latim major (pronunciava-se máior), que era o aumentativo de magnus, grande."), 
("Rastro; pegada deixada pelos pés ou pelas patas no lugar em que se passa.", "g", "Vestí_io", "Vestígio", 1,"Nas palavras terminadas em: -ágio, -égio, -ígio, -ógio e -úgio."),
("Sensação de uma tontura rotatória,que pode causar náuseas, vômitos, ilusão de movimento, etc.", "g", "Verti_em", "Vertigem", 1,"Escrito com g, diante dos substantivos terminados em: -agem, -igem e -ugem."),
("Coisa sobrenatural. Coisa ou pessoa anormal. Maravilha; milagre.", "g", "Prodí_io", "Prodígio", 1, "Vem do Latim prodigium."),
("Ponto de partida, o princípio de qualquer fato ocorrido.", "g", "Ori_em", "Origem", 1,"Nas palavras terminadas em: -ágio, -égio, -ígio, -ógio e -úgio."), 
("Instrumento formado por duas argolas de ferro que se coloca nos pulsos ou tornozelos das pessoas", "g", "Al_ema", "Algema", 1,"Vem do árabe AL-DJAMAA, pulseira."),
("Serpente que pode chegar aos 4 metros de comprimento e costuma habitar as àrvores de florestas úmidas.", "j", "_iboia", "Jiboia", 1,"Palavras de origem tupi."), 
("O ponto mais alto, o grau mais elevado, grau máximo.", "g", "Au_e", "Auge", 1,"Vem do árabe AUG: ponto mais alto, pico."),
("Automóvel com tração nas quatro rodas, rústico e robusto concebido para vencer terrenos hostis.", "j", "_ipe", "Jipe", 1,"Palavras aportuguesada do inglês. (Jeep)"), 
("Conselheiro, curandeiro, feiticeiro e intermediário espiritual de uma comunidade indígena.", "j", "Pa_é", "Pajé", 1,"Palavras de origem tupi."),

("Movimentar, deslocar, fazer mistura no interior de algo.", "x", "Me_er", "Mexer", 2, "Escrito com x, depois da sílaba inicial me- de origem do Latin."),
("Intrometida, fofoqueira, bisbilhoteira.", "x", "Me_eriqueira", "Mexeriqueira",  2,"Escrito com x, depois da sílaba inicial me- de origem do Latin."),
("Homem que nasceu no país do taco e do guacamole.", "x", "Me_icano", "Mexicano",  2, "Escrito com x, depois da sílaba inicial me- de origem do Latin."),
("Fruta Tropical cítrica.", "x", "Abaca_i", "Abacaxi", 2,"Em palavras de origem Indígena."), 
("Umbanda, Força divina, deus.", "x", "Ori_á", "Orixá", 2,"Palavra de origem Africana, 'ori' = cabeça, 'xá' = iluminação."),
("Sabão liquido usado para o couro cabeludo.", "x", "_ampu", "Xampu", 2,"Palavras aportuguesada do inglês. (Shampoo)"), 
("Comandante/Oficial de Policia no velho oeste.", "x", "_erife", "Xerife", 2,"Palavras aportuguesada do inglês. (Sheriff)"), 
("Conjunto de raios de luz que, tendo uma fonte comum, podem ser paralelos ou quase.", "x", "Fei_e", "Feixe", 2,"Em ditongos utilizasse X."),
("Solto, relaxado, desapertado, folgado.", "x", "Frou_o", "Frouxo", 2, "Em ditongos utilizasse X."),
("Fruto redondo com uma espécie de bico, doce e de epicarpo fino. Pode Ser seca.", "x", "Amei_a", "Ameixa",  2, "Em ditongos utilizasse X."),
("Esponja usada para limpar o corpo no banho", "ch", "Bu_a", "Bucha", 2,"Palavra proveniente do Arabe Lufa"), 
("Incidente no jogo do xadrez, que consiste em ficar o rei numa casa atacada por uma peça adversária.", "x", "_eque", "Xeque", 2,"Palavra Persa 'shah mat' que significa 'o rei está morto', aportuguesada como Xeque Mate"),
("Estabelecer preço de algo, ou onerar com impostos.", "x", "Ta_ar", "Taxar", 2,"Vem do Latim taxaRE, 'estimar, avaliar'"), 
("Atribuir defeito, acusar.", "ch", "Ta_ar", "Tachar", 2,"Vem do francês tache, que significa 'Mancha, nódoa, mácula'"),
("Ordem de pagamento escrita, pré-datado, rescrição.", "ch", "_eque", "Cheque", 2,"Palavras aportuguesada do inglês. (Check)"), 
("Dardo, lança, seta.", "ch", "Fle_a", "Flecha", 2,"Vem do Francês FLÉCHE."),

("Indiferença, falta de amabilidade; insensibilidade; indiferença.", "z", "Frie_a", "Frieza", 3,"Escrito com z, da palavra frio + sufixo -eza."),
("Sensação de desconforto no estômago com uma vontade urgente de vomitar.", "s", "Náu_ea", "Náusea", 3,"A palavra náusea vem de naus, que em grego quer dizer navio. "),
("Farinha de amido de milho usada na culinária", "s", "Mai_ena", "Maisena", 3, "Do Espanhol MAÍS, do Taino MAHIS, milho."),
("Embate recíproco de dois corpos. Luta. Contrariedade.", "s", "Coli_ão", "Colisão", 3, "Vem do Latim Collisio."), 
("Resultado final da combustão de uma substância como a madeira ou o carvão antes de virar cinzas.", "s", "Bra_a", "Brasa", 3, "Vem do Germânico Brasa, fogo."),
("Ato de não ter certeza de alguma coisa, qual a atitude deve ser tomada. ", "s", "He_itar", "Hesitar", 3, "Hesitar vem do Latim HAESITATIO, gagueira, irresolução."), 
("Substantivo feminino que nomeia o ato de fuga, de escape, de sumiço.", "s", "Eva_ão", "Evasão", 3, "Vem do Latim EVASIO, de EVADERE, fugir, escapar."), 
("Ato de retirar impurezas de um corpo, de um material ou de um local. ", "z", "Limpe_a", "Limpeza", 3,"Deriva do Latim limpiduz, transparente, claro, nítido."),
("Pedaços irregulares de gelo que caem do céu", "z", "Grani_o", "Granizo", 3,"Vem do Espanhol granizo."),
("Homem de bom coração.", "s", "Bondo_o", "Bondoso", 3, "Usa-se o 'S' nos sufixos -oso e -os quando formam adjetivos."),
("Sensação de queimação e dor ocasionada pelo ácido gástrico.", "z", "A_ia", "Azia", 3,"Vem do árabe Azia"), 
("Clientela, grupo de compradores fiéis.", "s", "Fregue_ia", "Freguesia", 3,"Ela vem de freguês, do Latim FILII ECCLESIAE, filhos da Igreja"),
("Mulher que cria e declama poemas.", "s", "Poeti_a", "Poetisa", 3,"Usa-se o S nos sufixos -esa e -isa, quando formam palavras do gênero feminino."), 
("Confusão dos sentidos que provoca uma distorção da percepção.", "s", "Ilu_ão", "Ilusão", 3,"Vem do Latim, é derivado de ILLUSIO, e significava algo muito parecido com ironia."),
("Uma arma de fogo, espingarda, carabina.", "z", "Fu_il", "Fuzil", 3,"Palavras oxítonas devem ser escrita com z, sem acento gráfico."), 
("Que expressa carinho, amor, meiguice e atenção.", "s", "Carinho_o", "Carinhoso", 3,"Usa-se o S nos sufixos -oso e -os quando formam adjetivos."),

("Que é capaz de agredir, de atacar.", "ss", "Agre_ivo", "Agressivo", 4,"Usa-se SS nos substantivos relacionados a verbos que contém o radical -gred."),
("Debate, controvérsia, polêmica, contenda ou disputa.", "ss", "Discu_ão", "Discussão", 4,"Usa-se SS nos substantivos que se relacionam a verbos constituídos da terminação -tir."),
("Extradição; Expelir; Ato de colocar pra fora.", "s", "Expul_ão", "Expulsão", 4, "Vem do Latin expulsione, devendo assim ser escrita com S."),
("Linha perpendicular, baixada do vértice de um ângulo sobre a corda de um arco, que tem por centro aquele vértice.", "ss", "Bi_etriz", "Bissetriz", 4, "Vem do Latin Bis + Sectriz."), 
("O oposto ao lado direito; Ao contrario.", "ss", "Ave_o", "Avesso", 4, "São usados SS entre vogais para que se mantenha o som normal de s (S entre vogais soa sibilante, como Z)."),
("Equiparada a um juramento, embora geralmente associada como uma tradição religiosa.", "ss", "Prome_a", "Promessa", 4, "Usa-se SS nas palavras relacionadas a verbos que se constituem do radical -met. "), 
("Aflição; desejo.", "s", "An_eio", "Anseio", 4, "Vem do  Latim ANXIETAS, S se aproxima do som do X."), 
("Ato ou efeito de imergir; imergência, submergir.", "s", "Imer_ão", "Imersão", 4,"Usa-se S nas palavras derivadas dos verbos terminados em -ergir."),
("Revogar; Anular ou invalidar os direitos políticos de; Inutilizar.", "ss",  "Ca_ar", "Cassar", 4, "São usados SS entre vogais para que se mantenha o som normal de s (S entre vogais soa sibilante, como Z)."),
("Ato ou efeito de aspergir água ou outro líquido.", "s", "Asper_ão", "Aspersão", 4, "Usa-se S nas palavras derivadas dos verbos terminados em -ergir"),
("Consentimento, permitir, transigência.", "ss", "Conce_ão", "Concessão", 4,"Usa-se SS nas palavras derivadas dos verbos terminados em -ceder"), 
("Brinquedo de parques de diversões, que girando em suas extremidades figuras como cavalos, aviões e etc.", "ss", "Carro_el", "Carrossel", 4,"São usados SS entre vogais para que se mantenha o som normal de s (S entre vogais soa sibilante, como Z)."),
("Passar p/ o outro lado de (algo), por cima ou através de.", "ss", "Atrave_ar", "Atravessar", 4,"São usados SS entre vogais para que se mantenha o som normal de s (S entre vogais soa sibilante, como Z)."), 
("Reparo, restauração, reforma, remediar, corrigir, colocar algo em bom estado.", "s", "Con_erto", "Conserto", 4,"Vem do Latim CONSERTARE, de CONSERERE."),
("Ação de reprimir; castigo; punição.", "ss", "Repre_ão", "Repressão", 4,"Usa-se SS nas palavras derivadas dos verbos terminados em prim"), 
("Falta de êxito; malogro; derrota.", "ss", "Fraca_o", "Fracasso", 4,"São usados SS entre vogais para que se mantenha o som normal de s (S entre vogais soa sibilante, como Z)."),

("Cobertura externa rígida, característica dos moluscos.", "n", "Co_cha", "Concha", 5,"Usa-se N quando está antes de outras consoantes, menos P e B."),
("Filhote de galinha.", "n", "Pi_to", "Pinto", 5,"Usa-se N quando está antes de outras consoantes, menos P e B."),
("Pequena peça metálica, recurvada, de duas hastes, com que as mulheres prendem os cabelos.", "m", "Gra_po", "Grampo", 5, "Usa-se M no final das palavras ou antes de P e B."),
("Perturbação oscilante de alguma grandeza física no espaço e periódica no tempo.", "n", "O_da", "Onda", 5, "Usa-se N quando está antes de outras consoantes, menos P e B."), 
("Instrumento de percussão.", "m", "Ta_bor", "Tambor", 5, "Usa-se M no final das palavras ou antes de P e B."),
("Estabelecimento comercial onde se vendem bebidas em geral e pequenos lanches; Bar de esquina; Boteco.", "m",  "Botequi_", "Botequim", 5,"Usa-se M no final das palavras ou antes de P e B."), 
("Ato de produzir sons musicais utilizando a voz, variando a altura de acordo com a melodia e o ritmo.", "n", "Ca_to", "Canto", 5, "Usa-se N quando está antes de outras consoantes, menos P e B."), 
("Utilizado na construção de barracas de festa junina, viveiros, varetas de pipas, laminados, construção de móveis.", "m", "Ba_bu", "Bambu", 5,"Usa-se M no final das palavras ou antes de P e B."),
("Fruta Tropical; Possui coloração variada: amarelo, laranja e vermelha.", "n","Ma_ga", "Manga", 5,"Usa-se N quando está antes de outras consoantes, menos P e B."),
("Profissionais das forças de segurança, responsáveis pelo combate a chamas.", "m", "Bo_beiro", "Bombeiro", 5, "Usa-se M no final das palavras ou antes de P e B."),
("Ocorrência de fogo não controlado, que pode ser extremamente perigosa para os seres vivos e as estruturas.", "n", "Incê_dio", "Incêndio", 5,"Usa-se N quando está antes de outras consoantes, menos P e B."), 
("Colega, camarada: companheiro de trabalho, de jogos, de estudos.", "m", "Co_panheiro", "Companheiro", 5,"Usa-se M no final das palavras ou antes de P e B."),
("Colega, camarada: companheiro de trabalho, de jogos, de estudos.", "n", "Compa_heiro", "Companheiro", 5,"Usa-se N quando está antes de outras consoantes, menos P e B."),
("Dispositivo elétrico que transforma energia elétrica em energia luminosa.", "m", "Lâ_pada", "Lâmpada", 5,"Usa-se M no final das palavras ou antes de P e B."),
("Sobremesa feita com Leite condensado.", "m", "Pudi_", "Pudim", 5,"Usa-se M no final das palavras ou antes de P e B."),
("Fruta doce e cítrica;  Geralmente é descascada e comida ao natural, ou espremida para obter sumo.", "n", "Lara_ja", "Laranja", 5,"Usa-se N quando está antes de outras consoantes, menos P e B."),

("Recipiente cilíndrico oco, tradicionalmente feito de varas de madeira e ligadas por aros de madeira ou metal, usado para colocar líquidos.", "rr", "Ba_il", "Barril", 6," Pronúncia de R forte entre duas vogais, deve-se usar RR. "),
("Mamífero canídeo. O mais antigo animal domesticado pelo ser humano. ", "rr", "Cacho_o", "Cachorro", 6," Pronúncia de R forte entre duas vogais, deve-se usar RR."),
("Objeto em forma de vaso, fabricado em vidro, cerâmica, porcelana, metal ou plástico, que serve para verter líquido em copos.", "rr", "Ja_a", "Jarra", 6, "Pronúncia de R forte entre duas vogais, deve-se usar RR."),
("Uma das flores mais populares no mundo. Símbolo dos apaixonados.", "r", "_osa", "Rosa", 6, "Utiliza-se R no início de palavras."), 
("Ferramenta de corte, consiste em uma lâmina larga com dentes afiados e travados, é usado normalmente para cortar madeira.", "rr", "Se_ote", "Serrote", 6, "Pronúncia de R forte entre duas vogais, deve-se usar RR. "),
("Que possui em grande quantidade, abundância, fartura, bom, agradável. Referencia uma pessoa que possui muitos bens materiais.", "R",  "_ico", "Rico", 6, "Utiliza-se R no início de palavras."), 
("Confronto sujeito a interesses da disputa entre dois ou mais grupos distintos,utilizando-se de armas para tentar derrotar o adversário.", "rr", "Gue_a", "Guerra", 6, "Pronúncia de R forte entre duas vogais, deve-se usar RR. "), 
("Princípio de comportamento do ser humano que age baseado em valores bondosos, como a honestidade, dignidade, valentia.", "r", "Hon_a", "Honra", 6,"Pronúncia de R forte entre consoante e vogal, deve-se usar R. "),
("Trama, intriga, mexerico, confusão, maquinação. ", "r","En_edo", "Enredo", 6,"Pronúncia de R forte entre consoante e vogal, deve-se usar R. "),
("Fixar profundamente; arraigar.", "r", "En_aizar", "Enraizar", 6, "Pronúncia de R forte entre consoante e vogal, deve-se usar R."),
("Fixar profundamente; arraigar.", "r", "Enraiza_", "Enraizar", 6, "Utiliza-se R no fim de palavras."),
("Marido da filha, em relaçao ao pai à mãe dela.", "r", "Gen_o", "Genro", 6,"Pronância de R forte entre consoante e vogal, deve-se usar R."), 
("Fora do comum, que foge da realidade, absurdo.", "rr", "Su_eal", "Surreal", 6,"Pronúncia de R forte entre duas vogais, deve-se usar RR. "),
("Pequeno mamífero pertencente à ordem dos roedores.", "r", "_ato", "Rato", 6,"Utiliza-se R no início de palavras."),
("Viagem gratuita em qualquer veículo.", "r", "Ca_ona", "Carona", 6,"Pronúncia de R fraco entre consoante e vogal, deve-se usar R."),
("Provocar queda; Pôr a baixo; demolir.", "rr", "De_ubar", "Derrubar", 6,"Pronúncia de R forte entre duas vogais, deve-se usar RR. "),
("Emendar os erros: cosertar os erros de ortografia, Reparar, Solucionar.", "rr", "Co_igir", "Corrigir", 6,"Pronúncia de R forte entre duas vogais, deve-se usar RR. "),

("Sair do seu país para estabelecer-se em outro.", "e", "_migrar", "Emigrar", 7,"Vem do Latim migrare, trocar de posição, mudar de residência. A partir de migrare temos emigrar, de ex-, para fora, mais migrare."),
("Em que há erro. Contrário à verdade.", "e", "Errôn_o", "Errôneo", 7,"Vem do Latim erroneus (errante)."),
("Aproveitar; Usufruir.", "e", "D_sfrutar", "Desfrutar", 7, "Forma-se por des-, aqui intensificativo, mais do Latin FRUI quer dizer: aproveitar, usar."),
("Isenção de serviço, dever ou encargo.", "i", "D_pensa", "Dispensa", 7, "Vem do Latim DISPENSATIO, administração, repartição, partilha."), 
("Aumentar de tamanho.", "i", "D_latar", "Dilatar", 7, "Vem do Latim DILATIO, de DILATARE, alargar, aumentar a superfície."),
("Instrumento usado para aplicar anestesia e outros medicamentos.", "e", "S_ringa", "Seringaa", 7, "Vem do Grego SYRINX: cano, canal."), 
("Denominação dada à medida de uma superfície.", "e", "ár_a", "área", 7, "Vem do Latim AREA."), 
("Oposto de masculino; Mulher.", "i", "Fem_nino", "Feminino", 7,"vem do Latim FEMELLA."),
("Atender ao que se pede, conceder, concordar.", "e", "D_ferir", "Deferir", 7,"Vem do Latim defferre, levar para outro lugar, conceder, outorgar."),
("Nome dado ao trabalhador rural nas estâncias gaúchas.", "e", "P_ão", "Peão", 7, "Vem do Latim PEDONE."),
("Distinguir, ser diferente, divergir, discordar.", "i", "D_ferir", "Diferir", 7,"Vem do Latim 'differre', discordar, colocar de lado, opor-se"), 
("VOLTAR  para o seu país. ", "i", "_migrar", "Imigrar", 7,"Imigrar, de immigrare,  passar por, de in-, para dentro, mais migrare."),
("Zombaria; o que se diz ou faz para zoar ou para caçoar de alguém ou de alguma coisa..", "e", "_scárnio", "Escárnio", 7,"Vem do Francâs dérision, zombaria"), 
("Levantar, eriçar (o cabelo ou pelos); Causar horror, susto.", "e", "Arr_piar", "Arrepiar", 7,"Vem do Latim HORRIPILARE, variante de HORRERE, que quer dizer: ficar de cabelo em pé, arrepiar."),
("Tipo de texto que enumera detalhadamente a aparência exterior de algo ou de alguém.", "e", "D_scrição", "Descrição", 7,"Vem do Latim descriptio, representação de algo, cópia."), 
("Ato impensado; imbecilidade ou parvoíce.", "i", "D_sparate", "Disparate", 7,"Vem do espanhol disparate."),
("Ato impensado; imbecilidade ou parvoíce.", "e", "Disparat_", "Disparate", 7,"Vem do espanhol disparate."),

("Estabelecimento comercial onde se vendem bebidas em geral e pequenos lanches.", "o", "B_tequim", "Botequim", 8,"Vem do português de Portugal botica que deriva do grego apothéke, que significa depósito."),
("Pedaço de tecido de linho ou de algodão usado para secar ou enxugar o corpo.", "o", "T_alha", "Toalha", 8,"Vem do Francês TOAILLE, que vem do Latim TELA, tecido, pano."),
("Bastão com encosto côncavo a que se apoiam os quem tem fratura em algum membro inferior (perna).", "u", "M_leta", "Muleta", 8, "Vem do Latim MULUS."),
("Transpirar, verter umidade pelo poros.", "u", "S_ar", "Suar", 8, "Vem Latim SUDOR."), 
("Diz-se de uma missão, um objetivo que foi finalizado com sucesso, com êxito.", "u", "C_mprimento", "Cumprimento", 8, "Vem do Latim cumplere, completar, satisfazer."),
("Ato de fazer algo pela garganta.", "o",  "Eng_lir", "Engolir", 8, "Vem do Latim ENGULLARE, de GULLA, garganta. "), 
("O termo originalmente denota a ideia de: farrapo.", "o", "M_lambo", "Molambo", 8, "Vem Do Quimbundo molambo: pano que se ata entre as pernas."), 
("Fazer bagunça, atrapalhar, encher o saco.", "o", "Z_ar", "Zoar", 8,"O verbo zoar é formado a partir da vocalização de uma onomatopeia, baseada nos sons da fala numa reprodução aproximada de um ruído exterior."),
("Ato de abastecer com o necessário, bem como ao ato de misturas coisas diversas. ", "o","S_rtir", "Sortir", 8,"Vem do latim sortire, sendo sinônimo de abastecer, aprovisionar, fornecer."),
("Abertura externa de alguns instrumentos.", "o", "B_cal", "Bocal", 8, "Vem de derivação sufixal: boca + al."),
("Mexer em algo, manusear.", "u", "B_lir", "Bulir", 8,"Vem do Latim 'BOLLIRE', ferver, agitar-se"), 
("Pedaço de Madeira.", "u", "Táb_a", "Tábua", 8,"Vem do Latim TABULA, peçaa de madeira grande achatada, mesa."),
("Ato de ter como resultado ou consequência, resultar. Ato de vir de dentro para fora, aparecer.", "u", "S_rtir", "Surtir", 8,"Derivação sufixal, da junção do sufixo -ir à palavra surto: surto + -ir."),
("Asquelmintos, nematódeos, ascarídeos, parasita do intestino do homem.", "o", "L_mbriga", "Lombriga", 8,"Vem do Latim LUMBRICUS, verme."),
("Relativo à boca.", "u", "B_cal", "Bucal", 8,"Vem latim buccale, devendo assim ser escrita com u."),
("Produzir, dar, emitir som, retumbar, ecoar", "o", "S_ar", "Soar", 8, "Vem latim 'sonare', por isso é escrito com a letra O.");



--INSERT INTO Rodada (tipoRodada, duracao, pontuacao, codJogador) VALUES 
--	("palavra", 16, 40, 1);

--INSERT INTO RodadaGrafema (codRodada, codGrafema) VALUES
--	(1, 1);

INSERT INTO Conquista(nomeConquista, experienciaDesbloqueio) VALUES 
  ("Entrou para a Academia de Novéis", 0),
  ("Encontrou o pergaminho dos Substantivos", 100),
  ("Dominou a técnica de detecção de Artigos", 200),
  ("Encontrou o vale dos Numerais", 600),
  ("Chegou ao reino Pronominal", 1000),
  ("Dominou a técnica da força Verbal", 1400),
  ("Aprendeu os golpes Adverbiais", 1800),
  ("Encontrou o Magnífico Livro das Interjeições", 2200),
  ("Aprendeu os ensinamentos antigos das Conjunções", 2600),
  ("Dominou as técnicas de defesa das Preposições", 3000),
  ("Dominou as técnicas da Análise Morfológica", 3800),
  ("Aprendeu a técnica de detecção de Sujeitos", 4400),
  ("Terminou a leitura do Livro dos Predicados", 5000),
  ("Chegou ao Reino Vocativo", 5800),
  ("Aprendeu a técnica de movimentação do Aposto", 6300),
  ("Encontrou o Complemento Nominal", 7000),
  ("Dominou a arte do Complemento Verbal", 8800),
  ("Adquiriu a força do Adjunto Adnominal", 9000),
  ("Aprendeu a técnica do Adjunto Adverbial", 9200),
  ("Dominou as técnicas da Análise Sintática", 9500);


--INSERT INTO ConquistaJogador(codConquista, codJogador) VALUES
--  (1,1);

INSERT INTO Cenas(nomeCena, nivelDesbloqueio, quadros) VALUES 
  ("cena1", 1, 8),
  ("cena2", 2, 1),
  ("cena3", 4, 1),
  ("cena4", 5, 1),
  ("cena5", 8, 1),
  ("cena6", 9, 1),
  ("cena7", 11, 1),
  ("cena8", 12, 2),
  ("cena9", 16, 2),
  ("cena10", 17, 2),
  ("cena11", 18, 1),
  ("cena12", 19, 1),
  ("cena13", 20, 1),
  ("cena14", 21, 1),
  ("cena15", 22, 1),
  ("cena16", 23, 1),
  ("cena17", 24, 9);

INSERT INTO Administrador (nome, email, login, senha) VALUES 
	("Administrador do Novel", "novel.noreply@gmail.com", "teste123", "teste123");

INSERT INTO Bonus (textoBonus, experienciaNecessaria) VALUES
	("ETEULRHGABILZTAWDODFEVMJZIVXNJCCOMCIESHOYNTQGHTNDGGTRCZPMKSIOXJPLWYOVBMUTRCCKBADOLTIYAXYWWAGPJOWSSDIKOPAMRUTVDDEUQIOXTOLRZDXUJIAHLQOOVNIPYOYBSXBBALPSDCLIOIRDERRPASFPEBOTGDTSEIWYBYTZLANOICIDSIRUJYLKMROXVNDJCVYKBQVROWNMVHAOFUJH", 200),
	("RPEMFLXPGTWAHZAAMZNRABREBOSSAIHPDQSMRVDGACMGCIWRUYZFFVIXYGZNFUZEWOUDQQAIQJETLWRNJCXZHWBVRCUEVOZDMNQDXPXRSAXWSIJIZPHQOKLEFOPEFCTZVIVOMYRMSSNJNRFAQTDBWEPNGESQRTYGXIEDNEVAWJZHORAEAKUEGYFYGIQMJAVMWVGPWJJBLKOASKZIXEESCLARECIMENTOD", 650),
	("PXGCPDMFOYYHZLHORIEUGUBASCXELQOQMMRSMXXQVXPDHGEMIQASLOGCOMTKFWLCZASVGEFNMTRCHDMWRYWREOSRUTUYKEQUNTMREZOMVAQJRGDOQHWNZZOSQJDPJABTGERKXZLBWEMFHIEQPKMPXUAMYECNTFINCARXJEDDSUATSFRAHNCVHPDXSRVWJASYKRNIRFIFRVSVJOUESRGLNAWASBAUPADXK", 1700),
	("JGFTAJPFQZVUCFAYKKOANZSUQNYXBCRIUGNITSIDBFMBLGMSFRSRGTEPDRUHCSNASZZAASYZLEWXCATCOENCPHYPIBYKMOJGGABEEXORSCJBLTJGCWNZKPOWWHXYGBGLGDYNKNLUCYPALSQBEWSWHBYKYHBRVFLRJWLXXMOTTZIOONENUZBHOQCWHCIMHZWKYADNHUBUESBASIDDKYYLANOICASNESFSI", 2750),
	("NLSEFHJWWZKCFSNJERSTLIEQTQWKBCWTLXVNIFWLCZCTFLOCBGKEVNIFKECVUBNEWSCGDUQMEHRGZRIRBOCNEECPIGJLCVLCGMGAGPVNVFIGBJZZGETTLCFDOGQLEZXTVAOYPREXWQFJILTPPZDCIKJUPCUNQEMSRDDMTBUIRMGKALOGYSOIWZJGUIZGUXNNLEYVLAXZBAIXELAVDAUXVLJIKHQRUJXAS", 3480);

	

INSERT INTO PalavraBonus (palavra, inicio, fim, codBonus) VALUES
	("ALGEMA",64,9,1),
	("CHOCARRICE",31,166,1),
	("JURISDICIONAL",194,182,1),
	("EXAUSTOR",158,53,1),
	("MUXOXO",57,132,1),
	("APRENDIZAGEM",16,192,2),
	("QUEROSENE",49,154,2),
	("ASSOBERBAR",29,20,2),
	("DEGENERESCENCIA",225,15,2),
	("ESCLARECIMENTO",211,224,2),
	("SABUGUEIRO", 25, 16,3),
	("SEMPRE", 169, 94,3),
	("ARRANHADURA", 216, 66,3),
	("FINCAR", 163, 158,3),
	("EXCERTO", 28, 112,3),
	("DISTINGUIR", 40, 31,4),
	("DESPENDER", 40, 160,4),
	("AROMA", 140, 204,4),
	("SENSACIONAL", 222, 212,4),
	("BUEIRO", 44, 119,4),
	("CHINFRIM", 59, 164,5),
	("BAIXELA", 201, 207,5),
	("JEJUM", 110, 170,5),
	("ENCOBRIR", 85, 78,5),
	("TANGENTE", 116, 4,5);
