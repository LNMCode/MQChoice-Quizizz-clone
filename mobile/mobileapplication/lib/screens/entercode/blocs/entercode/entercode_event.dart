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