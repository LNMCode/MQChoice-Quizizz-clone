import 'package:equatable/equatable.dart';

abstract class EnterCodeEvent extends Equatable {
  const EnterCodeEvent();

  @override
  List<Object?> get props => [];
}

class EnterCodeSumitted extends EnterCodeEvent {
  final String idroom;
  const EnterCodeSumitted(this.idroom);

  @override
  List<Object?> get props => [idroom];
}

class EnterCodeConnectedSocket extends EnterCodeEvent {
  final String idroom;
  final String iduser;
  final String nameuser;

  const EnterCodeConnectedSocket({
    required this.idroom,
    required this.iduser,
    required this.nameuser,
  });

  @override
  List<Object?> get props => [idroom, iduser, nameuser];
}
