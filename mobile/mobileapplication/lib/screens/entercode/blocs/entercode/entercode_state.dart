import 'package:equatable/equatable.dart';
import 'package:mobileapplication/models/checkidroom/entercode_response.dart';

class EnterCodeState extends Equatable {
  const EnterCodeState();

  @override
  List<Object?> get props => [];
}

class EnterCodeStateSuccess extends EnterCodeState {
  final EnterCodeResponse checkIdRoomResponse;
  const EnterCodeStateSuccess(this.checkIdRoomResponse);

  @override
  List<Object?> get props => [checkIdRoomResponse];
}

class EnterCodeStateLoading extends EnterCodeState {}

class EnterCodeStateFail extends EnterCodeState {}