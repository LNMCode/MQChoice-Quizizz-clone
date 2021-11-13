import 'package:equatable/equatable.dart';
import 'package:mobileapplication/models/checkidroom/entercode_response.dart';

class EnterCodeState extends Equatable {
  const EnterCodeState();

  @override
  List<Object?> get props => [];
}

// Enter code check idroom
class EnterCodeStateSuccess extends EnterCodeState {
  final EnterCodeResponse enterCodeResponse;
  const EnterCodeStateSuccess(this.enterCodeResponse);

  @override
  List<Object?> get props => [enterCodeResponse];
}

class EnterCodeStateLoading extends EnterCodeState {}

class EnterCodeStateFail extends EnterCodeState {}
